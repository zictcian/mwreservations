<template>
<body>
<div class="container-fluid">
    <form action="" method="post" @submit.prevent="handleSubmit">
        <h3>Register</h3>
        <hr>
        <div class="input-group mb-3">
            <label for="">Nombre</label>
            <input v-model="nombre" type="text" class="form-control inputwigth" placeholder="Nombre"/>
        </div>
        <div class="input-group mb-3">
            <label for="">Apellido Paterno</label>
            <input v-model="apellidopaterno" type="text" class="form-control inputwigth" placeholder="Primer apellido"/>
        </div>
        <div class="input-group mb-3">
            <label for="">Apellido Materno</label>
            <input v-model="apellidomaterno" type="text" class="form-control inputwigth" placeholder="Segundo apellido"/>
        </div>
        <div class="input-group mb-3">
            <label for="">Email</label>
            <input v-model="email" type="email" class="form-control inputwigth" placeholder="Email"/>
        </div>
        <div class="input-group mb-3">
            <label for="">Password</label>
            <input v-model="password" type="password" class="form-control forgot-password inputwigth" placeholder="Password"/>
        </div>
        <div class="input-group mb-3">
            <label for="">Confirmar password</label>
            <input v-model="confirmpassword" type="password" class="form-control forgot-password inputwigth" placeholder="Password"/>
        </div>
        <button type="submit" class="btn btn-primary mb-2">Registrar</button>
    </form>
</div>
</body>
</template>

<script>
import axios from 'axios'
export default {
  name: 'RegisterMW',
  data () {
    return {
      nombre: '',
      apellidopaterno: '',
      apellidomaterno: '',
      email: '',
      password: '',
      confirmpassword: ''
    }
  },
  methods: {
    async handleSubmit () {
      const response = await axios.post('register', {
        nombre: this.nombre,
        apellido: this.apellidopaterno,
        apellidomaterno: this.apellidomaterno,
        email: this.email,
        password: this.password,
        confirmpassword: this.confirmpassword
      })
      console.log(response)
      this.$router.push('/login')
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
