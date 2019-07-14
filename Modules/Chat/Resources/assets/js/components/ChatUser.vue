<template>
    <ul class="list-group user-list">
        <li class="list-group-item clearfix" v-for="(user, index) in users" :key="index + 0">
            <img src="https://irp-cdn.multiscreensite.com/3eea45f3/dms3rep/multi/mobile/avatar-icon.png" alt="avatar"/>
            <div class="about">
                <div class="name">{{ user.name }}</div>
                <div class="status">
                    <span class="badge badge-pill" :class="user.isOnline ? 'badge-success' : 'badge-danger'">
                        {{ user.isOnline ? 'Online' : 'Offline' }}
                    </span>
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

        beforeMount() {
            this.fetchAllUsers();
        },

        mounted() {

            window.Echo.join('chat')
                .here(users => {
                    users.map(item => {
                        this.users.find(u => u.id === item.id).isOnline = true;
                    })
                    //this.users = users
                })
                .joining(user => {
                    this.users.find(u => u.id === user.id).isOnline = true;

                    //this.users.push(user)
                })
                .leaving(user => {
                    this.users.find(u => u.id === user.id).isOnline = false;
                });
        },

        methods: {
            fetchAllUsers() {
                axios.get('/users').then(response => response.data)
                    .then(users => {
                        // Set all users as offline
                        users.map(item => {
                            item.isOnline = false;
                            this.users.push(item);
                        });
                    })
            },
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
    .offline {
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