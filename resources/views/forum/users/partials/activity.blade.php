@foreach($userActivities as $activity)
    @if($activity->getExtraProperty('type') === 'discussion')
        <div class="stream-small">
            <span class="label label-success"> Discussion</span>
            <span class="text-muted">{{ $activity->created_at->diffForHumans() }}</span>
            /
            <a href="{{ '/@' . $user->username }}">{{ $user->getNameOrUsername() }}</a>
            <span class="text-muted">{{ $activity->description }}</span>
            <a href="{{ $activity->getExtraProperty('link') }}">
                <span class="">{{ $activity->getExtraProperty('title') }}</span>
            </a>
        </div>
    @endif
@endforeach
