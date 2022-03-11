<template>
  <footer>
    <table>
      <tr>
        <th>Copyright © 2021. Todos los derechos reservados.</th>
        <th>Version: 1.0.0</th>
      </tr>
    </table>
  </footer>
</template>

<script>
export default {
  name: 'FooterMW'
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
 footer{
  background-color: rgb(214, 214, 214);
  border: black;
  height: 50px;
  width: 100%;
  bottom: 0;
  position: fixed;
}
</style>
