<template>
    <div class="input-group">
        <input id="btn-input" type="text" name="message" class="form-control input-sm"
               placeholder="Type your message here..." v-model="newMessage" @keydown="typing">

        <span class="input-group-btn">
            <button class="btn btn-primary ml-2" id="btn-chat" @click="sendMessage" :disabled='isDisabled'>
                Send
            </button>
        </span>
    </div>
</template>

<script>
    export default {

        props: ['user'],
        data() {
            return {
                newMessage: ''
            }
        },

        methods: {
            typing(e) {
                console.log(e.keyCode);
                console.log(e.shiftKey);
                if (e.keyCode === 13 && !e.shiftKey) {
                    //e.preventDefault();
                    this.sendMessage();
                }
            },
                sendMessage()
                {
                    // Check if message is empty
                    if(!this.newMessage || this.newMessage.trim() === '') {
                        return
                    }


                    this.$emit('messagesent', {
                        user: this.user,
                        message: this.newMessage,
                        selfMessage: true,
                        created_at: window.Moment().format('DD/MM/YYYY | k:m'),
                    });

                    this.newMessage = '';
                }
            },

            computed: {
                isDisabled: function () {
                    return !this.newMessage;
                }
            }
        }
</script>