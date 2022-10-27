@php
    $calling = App\Models\GroupCalling::where('message_id', $id)->first();
    //    $calling = false;
@endphp

{{-- -------------------- The default card (white) -------------------- --}}
@if ($viewType == 'default')
    {{-- @if ($from_id != Auth::id()) --}}
    <div class="message-card" data-id="{{ $id }}">
        <tr data-action="0">
            {{-- Avatar side --}}
            <td style="position: relative">
                <div class="avatar av-m" style="background-image: url('{{ filePath($from_avatar) }}');">
                </div>
            </td>
            {{-- center side --}}
            <td>
                <p>
                    {{ strlen($from_name) > 12 ? trim(substr($from_name, 0, 12)) . '..' : $from_name }}
                </p>

            </td>

        </tr>
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
            <div class="image-file chat-image"
                style="width: 250px; height: 150px;background-image: url('{{ App\Http\ChatifyMessenger::getAttachmentUrl($attachment[0]) }}')">
            </div>
        @endif
    </div>
    {{-- @endif --}}
@endif

{{-- -------------------- Sender card (owner) -------------------- --}}
@if ($viewType == 'sender')
    <div class="message-card mc-sender" title="{{ $fullTime }}" data-id="{{ $id }}">
        <div class="chatify-d-flex chatify-align-items-center"
            style="flex-direction: row-reverse; justify-content: flex-end;">
            <i class="fas fa-trash chatify-hover-delete-btn" data-id="{{ $id }}"></i>
            <p style="margin-left: 5px;">
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
            <div class="image-file chat-image"
                style="margin-top:10px;width: 250px; height: 150px;background-image: url('{{ App\Http\ChatifyMessenger::getAttachmentUrl($attachment[0]) }}')">
            </div>
        @endif
    </div>
@endif
