<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use App\Repositories\TranslationManagerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TranslationManagerController extends AppBaseController
{
    /** @var TranslationManagerRepository */
    private $translationManagerRepository;

    public function __construct(TranslationManagerRepository $translationManagerRepo)
    {
        $this->translationManagerRepository = $translationManagerRepo;
    }

    /**
     * Display a listing of the FAQ.
     *
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     *
     * @throws \Throwable
     */
    public function index(Request $request)
    {
        $selectedLang = $request->get('lang', 'en');
        $selectedFile = $request->get('file', 'messages');

        $allFilesArr = $this->translationManagerRepository->getAllFiles($selectedLang);
        $data = $this->translationManagerRepository->getAllLanguage($selectedLang, $selectedFile);
        $allLanguagesArr = $data['allLanguagesArr'];
        $selectedLangMessages = $data['selectedLangMessages'];

        if ($request->ajax()) {
            $data = view('translation-manager.languages_form', compact('selectedLangMessages'))->render();

            return $this->sendData($data);
        }

        return view('translation-manager.index',
            compact('selectedLangMessages', 'allLanguagesArr', 'selectedLang', 'allFilesArr', 'selectedFile'));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|regex:/^[a-zA-Z]+$/u|min:2',
            'code' => 'required|regex:/^[a-zA-Z]+$/u|min:2|max:2',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->messages()->first());
        }
        $input = $request->all();
        $this->translationManagerRepository->store($input);

        return $this->sendSuccess(__('messages.success_message.language_add'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        $lang = $request->get('lang');
        $file = $request->get('file');
        $result = $request->except('_token', 'lang', 'file');

        $this->translationManagerRepository->update($lang, $file, $result);

        return redirect()->route('translation-manager.index', ['lang' => $lang, 'file' => $file]);
    }
}
