@php
    $calling = App\Models\Calling::where('message_id', $id)->first();
   
@endphp

{{-- -------------------- The default card (white) -------------------- --}}
@if ($viewType == 'default')
    @if ($from_id != $to_id)
        <div class="message-card" data-id="{{ $id }}">
            <p>
                @if (!empty($calling))

                    @if ($calling->type === 'video_call ')
                        <i class="fas fa-video"></i> Video Call
                    @else
                        <i class="fas fa-phone"></i> Audio Call
                    @endif
                @else
                    {!! $message == null && $attachment != null && @$attachment[2] != 'file' ? $attachment[1] : nl2br($message) !!}
                @endif
                <sub title="{{ $fullTime }}">{{ $time }}</sub>
                {{-- If attachment is a file --}}
                @if (@$attachment[2] == 'file')
                    <a href="{{ App\Http\ChatifyMessenger::getAttachmentUrl($attachment[0]) }}" style="color: #595959;"
                        class="file-download">
                        <span class="fas fa-file"></span> {{ $attachment[1] }}</a>
                @endif
            </p>
            {{-- If attachment is an image --}}
            @if (@$attachment[2] == 'image')
                <div class="image-file chat-image img-cls2 "
                    style="background-image: url('{{ App\Http\ChatifyMessenger::getAttachmentUrl($attachment[0]) }}')">
                </div>
            @endif
        </div>
    @endif
@endif

{{-- -------------------- Sender card (owner) -------------------- --}}
@if ($viewType == 'sender')
    <div class="message-card mc-sender" title="{{ $fullTime }}" data-id="{{ $id }}">
        <div class="chatify-d-flex chatify-align-items-center chatify-d-flex-dsd"
            >
            <i class="fas fa-trash chatify-hover-delete-btn" data-id="{{ $id }}"></i>
            <p style="ml-5">
                @if (!empty($calling))
                    @if ($calling->type === 'video_call')
                        <i class="fas fa-video"></i> Video Call
                    @else
                        <i class="fas fa-phone"></i> Audio Call
                    @endif
                @else
                    {!! $message == null && $attachment != null && @$attachment[2] != 'file' ? $attachment[1] : nl2br($message) !!}
                @endif
                <sub title="{{ $fullTime }}" class="message-time">
                    <span class="fas fa-{{ $seen > 0 ? 'check-double' : 'check' }} seen"></span>
                    {{ $time }}</sub>
                </sub>
                {{-- If attachment is a file --}}
                @if (@$attachment[2] == 'file')
                    <a href="{{ App\Http\ChatifyMessenger::getAttachmentUrl($attachment[0]) }}" class="file-download">
                        <span class="fas fa-file"></span> {{ $attachment[1] }}</a>
                @endif
            </p>
        </div>
        {{-- If attachment is an image --}}
        @if (@$attachment[2] == 'image')
            <div class="image-file chat-image img-cls"
                style="background-image: url('{{ App\Http\ChatifyMessenger::getAttachmentUrl($attachment[0]) }}')">
            </div>
        @endif
    </div>
@endif
