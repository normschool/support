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

    public function searchFAQs(): LengthAwarePaginator
    {
        return $this->paginate();
    }

    public function model(): string
    {
        return FAQ::class;
    }

    public function searchableFields(): array
    {
        return [
            'title',
        ];
    }
}
