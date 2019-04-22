<template>
    <div>
        <transition-group :name="'fade'" tag="div">
            <div v-for="(message, index) in messages" :key="index + 0">
                <div class="message">
                    <div class="card-body p-2">
                        <div class="row">
                            <div class="col-8">
                                <h6 class=" mb-1 text-muted">{{ message.user.name }}:</h6>
                            </div>
                            <div class="col-4 ">
                                <small class=" mb-1 text-muted float-right">{{ message.user.created_at }}</small>
                            </div>
                        </div>
                        <p class="card-text">{{ message.message }}</p>
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
            scrollToEnd() {
                const chatPanel = document.querySelector("#chat-panel");

                chatPanel.scrollTo(0, chatPanel.scrollHeight);
            },
        },

        updated: function () {
            this.scrollToEnd();
        }
    };
</script>

<style>
    .message {
        border: 0;
        margin-bottom: 0.5rem;
        background-color: #ffffff;
    }

    .fade-enter {
        opacity: 0;
    }

    .fade-enter-active {
        transition: all 2s ease;
    }

</style>