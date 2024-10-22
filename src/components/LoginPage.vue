<template>
  <div class="d-flex vh-100">
    <!-- Bagian Kiri -->
    <div class="d-none d-lg-flex justify-content-center align-items-center w-100   bg-light">
      <div class="w-75">
        <p class="fs-2 fw-bold text-success">wms-saurus</p>
        <hr class="my-2">
        <p class="text-muted">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe magnam tempora cumque deserunt eum nemo explicabo delectus harum repellendus, corrupti excepturi? Unde iure quas rerum, eum odio magnam suscipit distinctio?
        </p>
        <p class="mt-5 text-muted">© Copyright 2024. All Rights Reserved.</p>
      </div>
    </div>

    <!-- Bagian Login -->
    <div class="d-flex justify-content-center align-items-center w-100 w-lg-50 bg-white">
      <div class="w-100 p-4 shadow-sm rounded bg-body" style="max-width: 400px;">
        <h1 class="text-center fs-4 fw-bold text-dark mb-4">Login WMS-Saurus</h1>
        <form @submit.prevent="submitForm" novalidate>
          <div class="mb-3">
            <label for="username" class="form-label text-muted">Username:</label>
            <input
              type="text"
              id="username"
              v-model="username"
              required
              :class="{'form-control': true, 'is-invalid': errors.username, 'is-valid': !errors.username && username}"
              @input="validateField('username')"
            />
            <div v-if="errors.username" class="invalid-feedback">
              Username tidak boleh kosong.
            </div>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label text-muted">Password:</label>
            <input
              type="password"
              id="password"
              v-model="password"
              required
              :class="{'form-control': true, 'is-invalid': errors.password, 'is-valid': !errors.password && password}"
              @input="validateField('password')"
            />
            <div v-if="errors.password" class="invalid-feedback">
              Password tidak boleh kosong.
            </div>
          </div>

          <button type="submit" class="btn btn-success w-100">Login</button>
        </form>

        <p 
          class="text-danger text-center mt-3 mb-0"
          :class="{ 'invisible': !errorMessage }"
        >
          {{ errorMessage }}
        </p>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      username: '',
      password: '',
      errorMessage: '',
      errors: {
        username: false,
        password: false,
      },
    };
  },
  mounted() {
    const isLoggedIn = localStorage.getItem('isLoggedIn');
    if (isLoggedIn) {
      this.$router.push({ name: 'Home' });
    }
  },
  methods: {
    validateField(field) {
      if (field === 'username') {
        this.errors.username = !this.username;
      } else if (field === 'password') {
        this.errors.password = !this.password;
      }
    },
    isFormValid() {
      this.errors.username = !this.username;
      this.errors.password = !this.password;
      return !this.errors.username && !this.errors.password;
    },
    async submitForm() {
      if (!this.isFormValid()) {
        this.errorMessage = 'Silakan isi semua data dengan benar';
        return;
      }

      try {
        const response = await fetch('http://localhost:8088/wms-saurus/back_end/action.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            username: this.username,
            password: this.password,
          }),
        });

        const data = await response.json();
        if (data.success) {
          localStorage.setItem('isLoggedIn', 'true');
          localStorage.setItem('username', this.username);
          this.$router.push({ name: 'Home' });
        } else {
          this.errorMessage = 'Login gagal. Silakan cek kembali.';
        }
      } catch (error) {
        this.errorMessage = 'Terjadi masalah. Silakan coba lagi nanti.';
      }
    },
  },
};
</script>
