<template>
<body>
<aside>
 <img src="../assets/restaurant.jpg" class="imagens">
</aside>
    <div class="cuerpo">
      <center><h2 class="display-4">MWReservations</h2>
      <hr>
      <h5 class="lead">Proporcionando conexiones entre lugares con comodidad y seguridad.</h5>
      <div class="relleno"><img class="imagenlogo" src="../assets/logoReservations.png"></div>
    </center>
    <a v-on:click="casa"><button class="btn btn-dark" style="margin-top: 50px;margin-left: 45%;"><i class="fa fa-sign-in"></i> Entrar</button></a>
    </div>
  </body>
</template>

<script>
export default {
  name: 'HomeMW',
  methods: {
    async casa () {
      if (localStorage.getItem('valor') === null) {
        localStorage.setItem('valor', '0')
      }
      localStorage.setItem('zona', '0')
      localStorage.setItem('zonaname', '')
      await this.$router.push({ name: 'InicioMW', replace: true })
      this.$router.go(0)
    }
  }
}
</script>

<style scoped>
.cuerpo{
  margin: 0%;
}
aside, .cuerpo {
  width: 50%;
  position: relative;
}
aside{
  color :#eee;
  position: relative;
}
.imagens{
  width: 100%;
  height: 100%;
}
.imagenlogo{
  width: 80%;
  border-radius: 50%;
}
.relleno{
  /*background-color: black;*/
  padding-top: 10px;
  padding-bottom: 10px;
}

</style>
