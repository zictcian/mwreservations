<template>
<body>
<div class="container-fluid">
    <form action="" method="post" @submit.prevent="handleSubmit">
        <h3>Login</h3>
        <hr>
        <div class="input-group mb-3">
            <label for="">Email</label>
            <input v-model="email" type="email" class="form-control inputwigth" placeholder="Email"/>
        </div>
        <div class="input-group mb-3">
            <label for="">Password</label>
            <input v-model="password" type="password" class="form-control forgot-password inputwigth" placeholder="Password"/>
        </div>
        <button type="submit" class="btn btn-primary mb-3">Login</button>
    </form>
    </div>
    </body>
</template>

<script>
import axios from 'axios'
export default {
  name: 'LoginMW',
  data () {
    return {
      email: '',
      password: ''
    }
  },
  methods: {
    async handleSubmit () {
      const response = await axios.post('login', {
        email: this.email,
        password: this.password
      })
      console.log(response)
      this.$router.push('/')
    }
  }
}
</script>

<style scoped>
.inputwigth{
    width: 40%;
    margin-left: 10px;
    margin-right: 10px;
}
label{
    width: 22%;
    text-align: left;
    margin-left: 10px;
}
body{
    background: url("../assets/image.png");
    background-repeat: no-repeat, repeat;
    background-position: center;
    background-size: cover;
    font-family: 'Fira Sans', sans-serif;
}
</style>
