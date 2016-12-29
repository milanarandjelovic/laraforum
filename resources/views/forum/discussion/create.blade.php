@extends('forum.layouts.app')

@section('title', '| Discussion')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Create New Discussion</h5>
                </div> {{-- /.ibox-title --}}
                <div class="ibox-content clearfix">
                    {!! Form::open(['route' => 'discussion.store', 'class' => 'form-horizontal']) !!}

                    {!! Form::hidden('user_id', Auth::user()->id, ['id' => 'user_id']) !!}

                    <div class="form-group{{ $errors->has('channel_id') ? ' has-error' : '' }}">
                        {!! Form::label('channel_id', 'Pick a Channel:', ['class' => 'control-label']) !!}
                        {!! Form::select('channel_id',$channels->pluck('name', 'id') , null , ['class' => 'form-control', 'placeholder' => 'Pick a Channel...']) !!}
                        @if($errors->has('channel_id'))
                            <span class="text-danger">{{ $errors->first('channel_id') }}</span>
                        @endif
                    </div> {{-- /.form-group --}}

                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        {!! Form::label('title', 'Provide a Title:', ['class' => 'control-label']) !!}
                        {!! Form::text('title', '', ['class' => 'form-control', 'id' => 'title']) !!}
                        @if($errors->has('title'))
                            <span class="text-danger">{{ $errors->first('title') }}</span>
                        @endif
                    </div> {{-- /.form-group --}}

                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                        {!! Form::label('description', 'Ask Away:', ['class' => 'control-label']) !!}
                        {!! Form::textarea('description', '', ['class' => 'form-control', 'placeholder' => 'What do you need help with? Be specific, so that you peers are better able to assist you.']) !!}
                        @if($errors->has('description'))
                            <span class="text-danger">{{ $errors->first('description') }}</span>
                        @endif
                    </div> {{-- /.form-group --}}

                    <div class="form-group pull-right">
                        <a href="{{ route('discussion.index') }}" class="btn btn-default">Cancel</a>
                        {!! Form::submit('Publish Discussions', ['class' => 'btn btn-primary']) !!}
                    </div> {{-- /.form-group --}}

                    {!! Form::close() !!}
                </div> {{-- /.ibox-content --}}
            </div> {{-- /.ibox --}}
        </div> {{-- /.col-lg-12 --}}
    </div> {{-- /.row --}}
@endsection