<template>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="../layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
</head>
<body id="top">

<div class="bgded overlay iniciofoto">
  <div id="pageintro" class="hoc clear">
    <article>
      <h2 class="heading">Todo lo que buscas en tu viaje</h2>
      <p>Sitio de reservaciones en linea</p>
      <footer>
        <ul class="nospace inline pushright">
          <li><a class="btn" href="/register">Crear una cuenta</a></li>
          <li><a class="btn inverse" href="/newsitio">añade tu sitio</a></li>
        </ul>
      </footer>
    </article>
  </div>
</div>
</body>
</template>

<script>
import '../layout/styles/layout.css'
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
.iniciofoto{
  background-image: url("../assets/Tripnombre.jpeg");
  background-repeat: no-repeat;
  background-size:cover;
}
</style>
