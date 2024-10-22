<template>
    <div>
        <h1>Welcome to Home Page</h1>
        <button @click="logout">Logout</button>
    </div>
</template>

<script>
export default {
    name: 'HomePage',
    mounted() {
        const isLoggedIn = localStorage.getItem('isLoggedIn');
        if (!isLoggedIn) {
            this.$router.push({ name: 'Login' }); // ke halaman login jika belum login
        }
    },
    methods: {
        logout() {
            localStorage.removeItem('isLoggedIn'); // log func 
            localStorage.removeItem('username'); 
            this.$router.push({ name: 'Login' }); 
        }
    }
};
</script>

<style scoped>
/* Tambahkan gaya jika perlu */
</style>
