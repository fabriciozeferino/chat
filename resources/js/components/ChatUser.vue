<template>
    <ul class="list-group user-list">
        <li class="list-group-item clearfix" v-for="(user, index) in users" :key="index + 0">
            <img src="https://irp-cdn.multiscreensite.com/3eea45f3/dms3rep/multi/mobile/avatar-icon.png" alt="avatar" />
            <div class="about">
                <div class="name">{{ user.name }}</div>
                <div class="status">
                    <span class="badge badge-pill badge-success">Online</span>
                </div>
            </div>
        </li>
    </ul>




</template>

<script>

    export default {
        data() {
            return {
                users: []
            }
        },

        mounted() {
            window.Echo.join('chat')
                .here(users => {
                    this.users = users
                })
                .joining(user => {
                    this.users.push(user)
                })
                .leaving(user => {
                    this.users = this.users.filter(u => (u.id !== user.id))
                });
        },

        methods: {

        }
    }
</script>

<style scoped>
    img {
        float: left;
        width: 50px;
        height: 50px;
    }

    .about {
        float: left;
        margin-top: 8px;
        padding-left: 8px;
    }

    .online,
    .offline{
        float: left;
        margin-right: 3px;
        font-size: 10px;
    }

    .online {
        color: #86bb71;
    }

    .offline {
        color: #e38968;
    }


</style>