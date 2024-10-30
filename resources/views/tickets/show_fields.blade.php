<div class="row details-page">
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ html()->label(__('messages.common.first_name') . ':', 'name') }}
        <p>{{ $ticket->title }}</p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ html()->label(__('messages.common.email') . ':', 'email') }}
        <p>{{ $ticket->email }}</p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ html()->label(__('messages.category.category') . ':', 'category') }}
        <p>{{ $ticket->category->name }}</p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ html()->label(__('messages.ticket.subject') . ':', 'subject') }}
        <p>{{ !empty($ticket->subject) ? $ticket->subject:__('messages.common.n/a') }}</p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ html()->label(__('messages.common.description') . ':', 'description') }}
        <p>{!!  !empty($ticket->description) ? $ticket->description:__('messages.common.n/a')!!}  </p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ html()->label(__('messages.common.created_on') . ':', 'created_on') }}
        <p>{{ date('jS M, Y', strtotime($ticket->created_at))  }}</p>
    </div>
    <div class="form-group col-xl-6 col-md-6 col-sm-12">
        {{ html()->label(__('messages.common.created_by') . ':', 'created_on') }}
        <p>{{ $ticket->user->name  }}</p>
    </div>
</div>
