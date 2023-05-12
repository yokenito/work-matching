@extends('layouts.app')

@push('script')
    <script src="{{asset('js/chat.js')}}"></script>
@endpush

@section('content')
        <div id="your_container">

            <!-- チャットの外側部分① -->
            <div id="bms_messages_container">
                <!-- ヘッダー部分② -->
                <div id="bms_chat_header">
                    <div id="bms_chat_user_name">●チャット</div>
                </div>

                <!-- タイムライン部分③ -->
                <div id="bms_messages">
                    <div id="addindex"></div>
                    <div id="scroll">
                        @foreach($chats as $chat)
                        @if($chat->user_id != $user_id)
                            <!--メッセージ１（左側）-->
                            <div class="bms_message bms_left">
                                <div class="bms_message_box">
                                    <div class="bms_message_content">
                                        <div class="bms_message_text">{!! nl2br($chat->message) !!}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="bms_clear"></div><!-- 回り込みを解除（スタイルはcssで充てる） -->
                        @elseif($chat->user_id == $user_id)
                            <!--メッセージ２（右側）-->
                            <div class="bms_message bms_right">
                                <div class="bms_message_box">
                                    <div class="bms_message_content">
                                        <div class="bms_message_text">{!! nl2br($chat->message) !!}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="bms_clear"></div><!-- 回り込みを解除（スタイルはcssで充てる） -->
                        @endif
                        @endforeach
                    </div>
                </div>

                <!-- テキストボックス、送信ボタン④ -->
                <div id="bms_send">
                    <textarea id="bms_send_message"></textarea>
                    <button onclick="sendmessage({{$proposal->id}})" id="bms_send_btn">
                        送信
                    </button>
                </div>
            </div>
        </div>

@endsection