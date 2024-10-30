<?php

namespace App\Http\Livewire;

use App\Models\FAQ;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class Faqfront extends SearchableComponent
{
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $faqs = $this->searchFAQs();

        return view('livewire.faqfront', [
            'faqs' => $faqs,
        ]);
    }

    /**
     * @return LengthAwarePaginator
     */
    public function searchFAQs(): LengthAwarePaginator
    {
        return $this->paginate();
    }

    /**
     * @return string
     */
    public function model(): string
    {
        return FAQ::class;
    }

    /**
     * @return array
     */
    public function searchableFields(): array
    {
        return [
            'title',
        ];
    }
}
