<template>
<center>
    <form action="" method="post">
        <h3>Login</h3>
        <hr>
        <div class="form-gruop">
            <label for="">Email</label>
            <input type="email" class="form-control" placeholder="Email"/>
        </div>
        <div class="form-gruop">
            <label for="">Password</label>
            <input type="password" class="form-control" placeholder="Password"/>
        </div>
        <button class="btn btn-primary btn-block">Login</button>
    </form>
    </center>
</template>

<script>
export default {
  name: 'LoginMW'
}
</script>
