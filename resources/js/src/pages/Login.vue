<template>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 login-box">
        <div class="col-lg-12 login-key">
          <i class="fa fa-key" aria-hidden="true"></i>
        </div>
        <div class="col-lg-12 login-title">
          Bienvenue
        </div>
        <div class="row">
          <div class="col-lg-6">
            <div class="col-lg-12 login-form">
              <form @submit.prevent="login">
                <div class="form-group">
                  <label class="form-control-label">USERNAME</label>
                  <input type="text" placeholder="Email or Phone" id="username" v-model="email" class="form-control">
                </div>
                <div class="form-group">
                  <label class="form-control-label">PASSWORD</label>
                  <input type="password" placeholder="Password" id="password" v-model="password" class="form-control">
                </div>

                <div class="col-lg-12 loginbttm">
                  <div class="col-lg-6 login-btm login-text">
                    <!-- Error Message -->
                    <p v-if="error" class="text-danger">Email ou mot de passe incorrect.</p>
                  </div>
                  <div class="col-lg-6 login-btm login-button">
                    <button type="submit" class="btn btn-outline-primary">LOGIN</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="col-lg-6">
            <img :src="logine" alt="" width="400" height="300" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
 import Cantine from "../assest/images/login.png"
export default {
    data() {
    return {
      logine : Cantine,
      email: '',
   password:'',
   error: false
    }
  },
    // name: 'LoginForm'
    // Assuming you have a login method in your component
methods: {
  login(){
    this.$store.dispatch('auth/login', {
            email: this.email,
            password: this.password,
            // remember: this.status,
          })
          .then(res => {
            console.log(this.$store.getters["auth/user_type"])
            if(this.$store.getters["auth/user_type"]==="professeur"){
              this.$router.push('/professeur')
            }
            else if(this.$store.getters["auth/user_type"]==="admin"){
              this.$router.push('/Administration')
            }
            else if(this.$store.getters["auth/user_type"]==="eleve"){
              this.$router.push('/Student')
            }
           else if(this.$store.getters["auth/user_type"]==="parent"){
             this.$router.push('/parent')
             }
                
          }).catch(error => {
          console.log(error)
          this.error = true

          })
console.log(  this.email)
console.log(  this.password)

  }

}

}
</script>

<style>
body {
    background: #ffffff;
    font-family: 'Roboto', sans-serif;
}

.login-box {
    margin-top: 75px;
    height: auto;
    background: #f7fafa;
    text-align: center;
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
}

.login-key {
    height: 100px;
    font-size: 80px;
    line-height: 100px;
    background: -webkit-linear-gradient(#27EF9F, #0DB8DE);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.login-title {
    margin-top: 15px;
    text-align: center;
    font-size: 30px;
    letter-spacing: 2px;
    margin-top: 15px;
    font-weight: bold;
    color: #5f6061;
}

.login-form {
    margin-top: 25px;
    text-align: left;
}

input[type=text] {
    background-color: #1A2226;
    border: none;
    border-bottom: 2px solid #0DB8DE;
    border-top: 0px;
    border-radius: 0px;
    font-weight: bold;
    outline: 0;
    margin-bottom: 20px;
    padding-left: 0px;
    color: #ECF0F5;
}

input[type=password] {
    background-color: #1A2226;
    border: none;
    border-bottom: 2px solid #0DB8DE;
    border-top: 0px;
    border-radius: 0px;
    font-weight: bold;
    outline: 0;
    padding-left: 0px;
    margin-bottom: 20px;
    color: #ECF0F5;
}

.form-group {
    margin-bottom: 40px;
    outline: 0px;
}

.form-control:focus {
    border-color: inherit;
    -webkit-box-shadow: none;
    box-shadow: none;
    border-bottom: 2px solid #0DB8DE;
    outline: 0;
    background-color: #1A2226;
    color: #ECF0F5;
}

input:focus {
    outline: none;
    box-shadow: 0 0 0;
}

label {
    margin-bottom: 0px;
}

.form-control-label {
    font-size: 10px;
    color: #6C6C6C;
    font-weight: bold;
    letter-spacing: 1px;
}

.btn-outline-primary {
    border-color: #0DB8DE;
    color: #0DB8DE;
    border-radius: 0px;
    font-weight: bold;
    letter-spacing: 1px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
}

.btn-outline-primary:hover {
    background-color: #0DB8DE;
    right: 0px;
}

.login-btm {
    float: left;
}

.login-button {
    padding-right: 0px;
    text-align: right;
    margin-bottom: 25px;
}

.login-text {
    text-align: left;
    padding-left: 0px;
    color: #A2A4A4;
}

.loginbttm {
    padding: 0px;
}
   
</style>
<style></style>