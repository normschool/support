<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Livewire\Component;

class BlockedUserSearch extends Component
{
    public $users = [];

    public $blockedContactIds = [];

    public $searchTerm;

    protected $listeners = [
        'clearSearchOfBlockedUsers' => 'clearSearchUsers',
        'addBlockedUserId' => 'addBlockedUserId',
        'removeBlockedUserId' => 'removeBlockedUserId',
    ];

    public function setBlockedContactIds(array $ids)
    {
        $this->blockedContactIds = $ids;
    }

    public function getBlockedContactIds(): array
    {
        return $this->blockedContactIds;
    }

    /**
     * initialize variables
     */
    public function mount($blockedByMeUserIds)
    {
        $this->setBlockedContactIds($blockedByMeUserIds);
    }

    /**
     * @return Application|Factory|View
     */
    public function render()
    {
        $this->searchUsers();

        return view('livewire.blocked-user-search');
    }

    /**
     * clear search
     */
    public function clearSearchUsers()
    {
        $this->searchTerm = '';

        $this->searchUsers();
    }

    /**
     * search users and apply filters
     */
    public function searchUsers()
    {
        $users = User::whereIn('id', $this->getBlockedContactIds())
            ->when($this->searchTerm, function ($query) {
                return $query->where(function ($q) {
                    $q->whereRaw('name LIKE ?', ['%'.strtolower($this->searchTerm).'%'])
                        ->orWhereRaw('email LIKE ?', ['%'.strtolower($this->searchTerm).'%']);
                });
            })
            ->orderBy('name', 'asc')
            ->select(['id', 'is_online', 'gender', 'photo_url', 'name', 'email'])
            ->limit(20)
            ->get();

        $this->users = $users;
    }

    public function addBlockedUserId(int $userId)
    {
        $blockedContactIds = $this->getBlockedContactIds();
        array_push($blockedContactIds, $userId);
        $this->setBlockedContactIds($blockedContactIds);
    }

    public function removeBlockedUserId(int $userId)
    {
        $blockedContactIds = $this->getBlockedContactIds();
        if (($key = array_search($userId, $blockedContactIds)) !== false) {
            unset($blockedContactIds[$key]);
        }
        $this->setBlockedContactIds($blockedContactIds);
    }
}
