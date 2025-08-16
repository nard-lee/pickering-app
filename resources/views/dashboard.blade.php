@extends('layouts.app') @section('title', 'Dashboard') @section('content')
<div class="bg-gray-200 w-[500px] flex flex-col gap-5 p-2">
    <h1 class="text-2xl border-b border-gray-300 pb-5 text-center font-bold">
        Welcome to Chatty
    </h1>
    <ul id="messages"></ul>
    <form id="chatForm" class="flex gap-2 border-t border-gray-300 pt-3">
        <input
            class="hidden"
            name="user_id"
            type="text"
            value="{{ Auth::user()->id }}"
        />
        <input
            class="hidden"
            name="f_name"
            type="text"
            value="{{ Auth::user()->name }}"
        />
        <input
            name="message"
            type="text"
            id="messageInput"
            placeholder="Type message..."
            class="w-full p-2 bg-gray-200 rounded"
        />
        <button
            class="bg-blue-300 p-2 rounded text-white cursor-pointer"
            type="submit"
        >
            Send
        </button>
    </form>
</div>
@endsection @section('scripts')
<script src="http://localhost:3000/socket.io/socket.io.js"></script>
<script>

        document.addEventListener("DOMContentLoaded", function () {

            const socket = io("http://localhost:3000");

            socket.on("chat message", ({ user_id, full_name, message }) => {
                const currentUserId = {{ Auth::id() }};
                if(user_id == currentUserId){
                    document.querySelector("#messages").innerHTML += `
                        <div class="w-full flex justify-end gap-2 mb-4">
                            <div class="flex items-start gap-1 space-x-3 flex-row-reverse max-w-md">
                                <div class="w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center font-medium text-sm shrink-0">
                                    ${full_name.charAt(0).toUpperCase()}
                                </div>
                                <div class="bg-blue-500 text-white px-3 py-2 rounded-lg">
                                    <p class="text-xs text-blue-100 mb-1">${full_name}</p>
                                    <p>${message}</p>
                                </div>
                            </div>
                        </div>
                    `;
                } else {
                        document.querySelector('#messages').innerHTML += `
                        <div class="w-full flex justify-start gap-2 mb-4">
                            <div class="flex items-start space-x-3 max-w-md">
                                <div class="w-8 h-8 rounded-full bg-gray-500 text-white flex items-center justify-center font-medium text-sm shrink-0">
                                    ${ full_name.charAt(0).toUpperCase() }
                                </div>
                                <div class="bg-gray-100 text-gray-800 px-3 py-2 rounded-lg">
                                    <p class="text-xs text-gray-600 mb-1">${ full_name }</p>
                                    <p>${ message }</p>
                                </div>
                            </div>
                        </div>
                        `;
                }
            });

            document
                .querySelector("#chatForm")
                .addEventListener("submit", (event) => {
                    event.preventDefault();

                    const input = event.target;
                    const user_id = input.user_id.value;
                    const full_name = input.f_name.value;
                    const message = input.message.value.trim();

                    if (message) {
                        console.log("Sending message:", message);
                        socket.emit("chat message", {
                            user_id,
                            full_name,
                            message,
                        });
                        input.message.value = "";
                    }
                });
        });
</script>
@endsection
