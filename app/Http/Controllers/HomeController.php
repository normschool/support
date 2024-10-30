<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\FAQ;
use App\Models\Setting;
use App\Models\Ticket;
use App\Models\User;
use App\Repositories\WebHomeRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View as ViewProvider;
use Illuminate\View\View;
use Throwable;

class HomeController extends Controller
{
    private $webHomeRepository;

    public $settings = null;

    /**
     * HomeController constructor.
     */
    public function __construct(WebHomeRepository $webHomeRepository)
    {
        $this->webHomeRepository = $webHomeRepository;
        // to share settings value to all view files.
        $this->settings = Setting::all()->pluck('value', 'key')->toArray();
        ViewProvider::share('settings', $this->settings);
    }

    /**
     * @return Application|Factory|View
     */
    public function index(): View
    {
        $categories = Category::withCount([
            'ticket' => function ($query) {
                $query->where('status', '=', Ticket::STATUS_OPEN);
            },
        ])->orderBy('name')
            ->having('ticket_count', '>', 0)
            ->limit(9)
            ->get();
        $publicTickets = $this->webHomeRepository->getPublicTickets();

        return view('web.home', compact('categories', 'publicTickets'));
    }

    /**
     * @return Factory|View
     */
    public function createTicket(): View
    {
        $category = Category::orderBy('name')->pluck('name', 'id')->toArray();
        $customers = User::whereHas('roles', function (Builder $query) {
            $query->where('name', '=', 'Customer');
        })->orderBy('name')->pluck('name', 'id');

        return view('web.create_ticket', compact('category', 'customers'));
    }

    /**
     * @return Factory|View
     */
    public function faqs(): View
    {
        $faqs = FAQ::all();

        return view('web.faqs', compact('faqs'));
    }

    /**
     * @return Factory|View
     */
    public function searchTicketForm(): View
    {
        return view('web.search_ticket_form');
    }

    /**
     * @return Application|Factory|View
     */
    public function searchTicket(Request $request): View
    {
        $input = $request->only(['ticket_id', 'email']);
        $ticket = $this->webHomeRepository->searchTicket($input);

        return view('web.view_ticket', compact('ticket'));
    }

    /**
     * @return array|string
     *
     * @throws Throwable
     */
    public function getPublicTickets(Request $request)
    {
        $searchTerm = strtolower($request->get('searchTerm'));
        if ($searchTerm) {
            $publicTickets = Ticket::whereIsPublic(1)->where(function (Builder $query) use ($searchTerm) {
                return $query->where('title', 'LIKE', '%'.$searchTerm.'%')
                    ->orWhere('email', 'LIKE', '%'.$searchTerm.'%');
            })->get();

            return view('web.public_tickets_results', compact('publicTickets'))->render();
        }
    }
}
