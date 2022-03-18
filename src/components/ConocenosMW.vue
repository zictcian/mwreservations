<template>
    <div class="cuerpo">
        <table>
        <tr class="th">
        <th><img src="../assets/mwc.png" alt=""></th>
           <th>
           <table>
               <th class="th">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="logo" style="text-align: center;"><br>
                    <h4 style="color: #000; font-size: 19px;"><strong>Empresa de Servicios en Consultoría, Capacitación y Sistemas Informáticos</strong><br>
                      <strong style="color: #7c7676; font-size: 17px;">Sectores Gobierno y Privado</strong>
                    </h4>
                </div>
            </div>
               </th>
               <th>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
              <div class="logo" style="text-align: center;">
                    <tr><a href="mailto:walter@mwc.com.mx"><strong>walter@mwc.com.mx </strong></a>
                    <i class="fa fa-envelope" aria-hidden="true"></i></tr>
                    <tr><a onclick="window.open('https://api.whatsapp.com/send?phone=529611236817&amp;text=Me gustaria registarme','_blank')" href="javascript:void(0);"><strong>Celular: 961 123 68 17 </strong></a>
                    <i class="fa fa-whatsapp" aria-hidden="true"></i></tr>
                    <tr><a href="https://www.facebook.com/MWConsultores/" target="_blank"><strong>Facebook </strong></a>
                    <i class="fa fa-facebook-square" aria-hidden="true"></i></tr>
                    <tr><a href="./"><strong>Visitas</strong></a>
                    <span class="timer" data-from="1" data-to="20566" data-speed="5000" data-refresh-interval="20566"> 20566 </span>
                    <i class="fa fa-eye"></i></tr>
                    <tr><div class="fb-like fb_iframe_widget" data-href="http://mwc.com.mx/" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="true" fb-xfbml-state="rendered" fb-iframe-plugin-query="action=like&amp;app_id=&amp;container_width=722&amp;href=http%3A%2F%2Fmwc.com.mx%2F&amp;layout=button_count&amp;locale=es_LA&amp;sdk=joey&amp;share=true&amp;show_faces=false&amp;size=small"><span style="vertical-align: bottom; width: 220px; height: 28px;">
                    <iframe name="fc4410b5ff88b8" width="1000px" height="1000px" data-testid="fb:like Facebook Social Plugin" title="fb:like Facebook Social Plugin" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" allow="encrypted-media" src="https://www.facebook.com/v3.3/plugins/like.php?action=like&amp;app_id=&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fx%2Fconnect%2Fxd_arbiter%2F%3Fversion%3D46%23cb%3Df39268591c3a6f8%26domain%3Dmwc.com.mx%26is_canvas%3Dfalse%26origin%3Dhttps%253A%252F%252Fmwc.com.mx%252Ff1a1819ebebb3bc%26relation%3Dparent.parent&amp;container_width=722&amp;href=http%3A%2F%2Fmwc.com.mx%2F&amp;layout=button_count&amp;locale=es_LA&amp;sdk=joey&amp;share=true&amp;show_faces=false&amp;size=small" style="border: none; visibility: visible; width: 220px; height: 28px;" class=""></iframe></span></div></tr>
              </div>
          </div>
               </th>
           </table>
           </th>
        </tr>
    </table>
    <hr>
    </div>
    <button class="boton">
        <center><a class="mw" href="https://mwc.com.mx/">Ir a MWConsultores </a><i class="fa fa-external-link mw"></i></center>
    </button><br>
    <img class="espacio" src="https://mwc.com.mx/assets/cursos/1.jpg" alt="">
</template>
<script>
export default {
  name: 'ConocenosMW'
}
</script>
<style scoped>
h1{
    font-size: larger;
}
.th{
    width: 1200px;
}
.cuerpo {
    background-color: plum;
}
.boton {
    margin-top: 50px;
    border-color: black;
    background-color: orange;
    position: relative;
    width: 45%;
}
.espacio{
    margin-bottom: 220px;
    padding-top: 50;
}
.boton:hover{
    background-color: green;
}
.mw{
 color: white;
}
.cuerpo{
    background-color: rgb(214, 214, 214);
  border: black;
  height: 220px;
  width: 100%;
  bottom: 0;
  position: fixed;
  margin-top: 300px;
}
</style>
