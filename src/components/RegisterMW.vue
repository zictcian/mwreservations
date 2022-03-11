<template>
<head>
  <meta charset="utf-8">
</head>
<body>
<div class="container-fluid">
    <form @submit="postData">
        <h3>Register</h3>
        <p id="resultado">Cuenta de: {{posts.nombre}} {{posts.Apaterno}} {{posts.Amaterno}}</p>
        <hr>
        <div class="input-group mb-3">
            <label for="">Nombre</label>
            <input name="nombre" v-model="posts.nombre" type="text" class="form-control inputwigth" placeholder="Nombre"/>
        </div>
        <div class="input-group mb-3">
            <label for="">Apellido Paterno</label>
            <input name="Apaterno" v-model="posts.Apaterno" type="text" class="form-control inputwigth" placeholder="Primer apellido"/>
        </div>
        <div class="input-group mb-3">
            <label for="">Apellido Materno</label>
            <input name="Amaterno" v-model="posts.Amaterno" type="text" class="form-control inputwigth" placeholder="Segundo apellido"/>
        </div>
        <div class="input-group mb-3">
            <label for="">Email</label>
            <input name="email" v-model="posts.email" type="email" class="form-control inputwigth" placeholder="Email"/>
        </div>
        <div class="input-group mb-3">
            <label for="">Password</label>
            <input name="password" v-model="posts.password" type="password" class="form-control forgot-password inputwigth" placeholder="Password"/>
        </div>
        <div class="input-group mb-3">
            <label for="">Confirmar password</label>
            <input name="password2" v-model="posts.password2" type="password" class="form-control forgot-password inputwigth" placeholder="Password"/>
        </div>
        <span class="error inputwigth" v-if="passwordError2">{{passwordError2}}</span>
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
      posts: {
        nombre: '',
        Apaterno: '',
        Amaterno: '',
        email: '',
        password: '',
        password2: ''
      },
      passwordError2: ''
    }
  },
  methods: {
    postData (e) {
      if (this.posts.password !== this.posts.password2) {
        this.passwordError2 = '* Error las contraseñas no coinciden'
        alert('Error detectado')
      } else {
        this.axios.post('/register', this.posts).then((resultado) => {
          console.warn(resultado)
        })
      }
      e.preventDefault()
    },
    register () {
      axios.post('/login', {
        nombre: this.nombre,
        apellido: this.apellidopaterno,
        apellidomaterno: this.apellidomaterno,
        email: this.email,
        password: this.password,
        confirmpassword: this.confirmpassword
      })
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
.btn{
  margin-left: 45%;
}
.error{
  color: red;
  font-family: 'Times New Roman', Times, serif;
  font-size: 10px;
  margin-left: 25%;
  padding-top: 0%;
  margin-top: 0%;
}
</style>
