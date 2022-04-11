<template>
<body>
<div class="container-fluid">
    <div class="form-group forma">
        <h3>Nuevo sitio</h3>
        <p id="resultado">Cuenta de: <span class="badge badge-pill badge-success">{{nombre}} {{Apaterno}} {{Amaterno}}</span></p>
        <hr>
        <div class="input-group mb-3">
            <label for="nombre">Nombre</label>
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="bi bi-person-lines-fill"></i></span>
            </div>
            <input name="nombre" v-model="nombre" type="text" class="form-control inputwigth" placeholder="Nombre"/>
        </div>
        <div class="input-group mb-3">
            <label for="Apaterno">Apellido Paterno</label>
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="bi bi-person-lines-fill"></i></span>
            </div>
            <input name="Apaterno" v-model="Apaterno" type="text" class="form-control inputwigth" placeholder="Primer apellido"/>
        </div>
        <div class="input-group mb-3">
            <label for="Amaterno">Apellido Materno</label>
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="bi bi-person-lines-fill"></i></span>
            </div>
            <input name="Amaterno" v-model="Amaterno" type="text" class="form-control inputwigth" placeholder="Segundo apellido"/>
        </div>
        <div class="input-group mb-3">
            <label for="email">Email</label>
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="bi bi-envelope"></i></span>
            </div>
            <input name="email" v-model="email" type="email" class="form-control inputwigth" placeholder="Email"/>
        </div>
        <div class="input-group mb-3">
            <label for="password">Password</label>
            <div class="input-group-prepend">
              <span class="input-group-text">(*)</span>
            </div>
            <input name="password" v-model="password" type="password" class="form-control forgot-password inputwigth" placeholder="Password"/>
        </div>
        <div class="input-group mb-3">
            <label for="password2">Confirmar password</label>
            <div class="input-group-prepend">
              <span class="input-group-text">(*)</span>
            </div>
            <input name="password2" v-model="password2" type="password" class="form-control forgot-password inputwigth" placeholder="Password"/>
        </div>
        <div class="input-group mb-3">
            <label for="Amaterno">Nombre del local</label>
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="bi bi-shop"></i></span>
            </div>
            <input name="Local" v-model="local" type="text" class="form-control inputwigth" placeholder="Nombre del local"/>
        </div>
        <div class="input-group mb-3">
            <label for="Amaterno">Estado del local</label>
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="bi bi-shop"></i></span>
            </div>
            <select class="custom-select inputwigth" id="zonaselected">
              <option selected></option>
                <option :value="zona.id" v-for="(zona ,index) in zonas" :key="index">{{index+1}}. {{zona.estado}}</option>
              </select>
        </div>
        <div class="input-group mb-3">
            <label for="Amaterno">Categoria del local</label>
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="bi bi-tag"></i></span>
            </div>
            <select class="custom-select inputwigth" id="catselected">
                <option selected></option>
                <option :value="categoria.id" v-for="(categoria ,index) in categorias" :key="index">{{index+1}}. {{categoria.categoria}}</option>
              </select>
        </div>
        <div class="inputwigth error"><span class="" v-if="passwordError2">{{passwordError2}}</span></div>
        <button v-on:Click="postData" class="btn btn-primary mb-2">Registrar</button><br>
        <a href="/login" class="btn2">ya tengo cuenta! gracias</a>
    </div>
</div>
</body>
<br>
</template>

<script>
export default {
  name: 'SitioRegister',
  data () {
    return {
      nombre: '',
      Apaterno: '',
      Amaterno: '',
      email: '',
      password: '',
      password2: '',
      passwordError2: '',
      local: '',
      zonas: [],
      categorias: []
    }
  },
  created: function () {
    this.traerzonas()
    this.traercat()
  },
  methods: {
    traerzonas () {
      const formdata = new FormData()
      formdata.append('IdUsua', localStorage.getItem('valor'))
      fetch('https://expresstrip.mwcomeniusdocente.com/app/zone.php', {
        method: 'POST',
        body: formdata
      }).then(
        respuest => respuest.json()
      ).then((datosRespuest) => {
        console.log(datosRespuest)
        this.zonas = []
        if (typeof datosRespuest[0].success === 'undefined') {
          this.zonas = datosRespuest
        }
      }).catch(console.log)
    },
    traercat () {
      const formdata = new FormData()
      formdata.append('IdUsua', localStorage.getItem('valor'))
      fetch('https://expresstrip.mwcomeniusdocente.com/app/categorias.php', {
        method: 'POST',
        body: formdata
      }).then(
        respuest => respuest.json()
      ).then((datosRespuest) => {
        console.log(datosRespuest)
        this.categorias = []
        if (typeof datosRespuest[0].success === 'undefined') {
          this.categorias = datosRespuest
        }
      }).catch(console.log)
    },
    encryp: async function (palabra) {
      const palabraencryp = btoa(palabra)
      console.log(palabra)
      console.log(palabraencryp)
      return palabraencryp
    },
    desencryp: function (palabra) {
      const palabradesencryp = atob(palabra)
      console.log(palabra)
      console.log(palabradesencryp)
      return palabradesencryp
    },
    async postData () {
      this.passwordError2 = ''
      if (this.email === '') {
        this.passwordError2 = this.passwordError2 + ' *El correo es obligatorio'
      }
      if (this.nombre === '') {
        this.passwordError2 = this.passwordError2 + ' *El nombre es obligatorio'
      }
      if (this.Apaterno === '') {
        this.passwordError2 = this.passwordError2 + ' *El apellido paterno es obligatorio'
      }
      if (this.password.length < 8) {
        this.passwordError2 = this.passwordError2 + ' *El password debe ser minimo 8 caracteres'
      } else if (this.password === this.nombre) {
        this.passwordError2 = this.passwordError2 + ' *El password no puede ser el nombre'
      }
      if (this.password !== this.password2) {
        this.passwordError2 = this.passwordError2 + ' *Las contraseñas deben coincidir'
      }
      if (this.local === '') {
        this.passwordError2 = this.passwordError2 + ' *El nombre del local es obligatorio'
      }
      const newzona = document.getElementById('zonaselected').value
      console.log(newzona)
      if (newzona === '') {
        this.passwordError2 = this.passwordError2 + ' *Selecciona una zona'
      }
      const newcat = document.getElementById('catselected').value
      console.log(newcat)
      if (newcat === '') {
        this.passwordError2 = this.passwordError2 + ' *Selecciona una categoria'
      }
      if (this.passwordError2 === '') {
        this.password = await this.encryp(this.password)
        this.prueba(newzona, newcat)
      } else {
        this.$swal('error', 'Se detecto una inconsistencia', 'info')
      }
    },
    async a (data) {
      data.append('token', '12345')
      data.append('actividad', 'Creación de cuenta MWReservation')
      await fetch('https://expresstrip.mwcomeniusdocente.com/app/enviarmail.php', {
        method: 'POST',
        body: data
      }).then(
        respuest => respuest.json()
      ).then(datosRespuest => {
        console.log(datosRespuest)
      }).catch(console.log)
    },
    prueba (newzona, newcat) {
      this.$swal.fire({
        title: 'Verficación',
        text: '¿Tus datos ya están verificados?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si',
        cancelButtonText: 'No',
        showCloseButton: true,
        showLoaderOnConfirm: true
      }).then((result) => {
        if (result.value) {
          this.register(newzona, newcat)
        } else {
          this.$swal('Cancelado', 'operación cancelada', 'info')
        }
      })
    },
    async register (newzona, newcat) {
      const formdata = new FormData()
      formdata.append('correo', this.email)
      formdata.append('password', this.password)
      formdata.append('nombre', this.nombre)
      formdata.append('Apaterno', this.Apaterno)
      formdata.append('Amaterno', this.Amaterno)
      formdata.append('local', this.local)
      formdata.append('zona', newzona)
      formdata.append('cat', newcat)
      await fetch('https://expresstrip.mwcomeniusdocente.com/app/registrarsitio.php', {
        method: 'POST',
        body: formdata
      }).then(
        respuest => respuest.text()
      ).then((datosRespuest) => {
        console.log(datosRespuest)
        if (datosRespuest === 'error') {
          this.$swal('Creación cancelada', 'El correo ya esta registrado', 'info')
        } else {
          this.a(formdata)
          this.$swal('Usuario creado', 'Ahora, inicia sesión', 'success')
          this.$router.push({ name: 'LoginMW', params: { email: this.email } })
        }
      }).catch(e => {
        console.log(e)
        this.$swal('Error', 'No creado', 'info')
      })
    }
  }
}
</script>

<style scoped>
.inputwigth{
    width: 60%;
    margin-left: 0px;
    margin-right: 10px;
}
label{
    width: 22%;
    text-align: left;
    margin-left: 10px;
}
body{
    background-repeat: no-repeat, repeat;
    background-position: center;
    background-size: cover;
    font-family: 'Fira Sans', sans-serif;
}
.btn{
  margin-left: 45%;
}
.btn2{
  display: flex;
  text-align: center;
  vertical-align: top;
  margin: 0 0 1rem;
  align-items: start;
  justify-content: center;
}
.btn2:hover{
  text-decoration: underline;
}
.btn1{
  margin-left: 40%;
  text-decoration: underline;
  text-align: center;
}
.error{
  color: red;
  font-family: 'Times New Roman', Times, serif;
  font-size: 10px;
  margin-left: 25%;
  padding-top: 0%;
  margin-top: 0%;
}
.forma{
  background-color: rgb(242,247,235);
  align-content: center;
  align-items: center;
  margin-top: 50px;
  margin-left: 15%;
  margin-right: 15%;
}
</style>
