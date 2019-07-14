<template>
    <div>
        <transition-group :name="'fade'" tag="div">
            <div v-for="(message, index) in messages" :key="index + 0">
                <div class="message">
                    {{ message.user.name }}:
                    <div :class="message.selfMessage ? 'sent_msg' : 'received_msg'">
                        <p>{{ message.message }}</p>
                        <span class="time_date">{{ message.created_at }}</span>
                    </div>
                </div>

            </div>
        </transition-group>
    </div>
</template>

<script>
    export default {
        props: ['messages'],

        methods: {
            scrollPageToEnd() {
                const chatPanel = document.querySelector("#chat-panel");

                chatPanel.scrollTo(0, chatPanel.scrollHeight);
            },
        },

        updated: function () {
            this.scrollPageToEnd();
        }
    };
</script>

<style>
    p {
        font-size: 14px;
        display: inline-block;
    }
    .message {
        border: 0;
        margin-bottom: 20px;
    }

    .sent_msg p {
        background: #0465ac;
        color: #ffffff;
        border-radius: 0 15px 15px 15px;
        margin: 0;
        padding: 5px 10px 5px 12px;
        text-align: justify;
    }

    .received_msg p {
        background: #ebebeb;
        color: #545454;
        border-radius: 0 15px 15px 15px;
        margin: 0;
        padding: 5px 10px 5px 12px;
        text-align: justify;
    }

    .time_date {
        color: #747474;
        display: inline-block;
        font-size: 12px;
        margin: 1px 0 0;
    }

    .fade-enter {
        opacity: 0;
    }

    .fade-enter-active {
        transition: all 1s ease;
    }
</style>