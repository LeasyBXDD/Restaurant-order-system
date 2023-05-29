<template>
  <van-form @submit="onSubmit">
    <van-field v-model="username" name="username" label="用户名" placeholder="请输入用户名" />
    <van-field v-model="password" type="password" name="password" label="密码" placeholder="请输入密码" />
    <van-button round block type="primary" native-type="submit">登录</van-button>
  </van-form>
</template>
  
<script>
import axios from 'axios';
import { ref } from 'vue';
import router from '../router';

export default {
  setup() {
    const username = ref('');
    const password = ref('');

    const onSubmit = () => {
      axios.post('../php/login.php', {
        username: username.value,
        password: password.value
      })
        .then(response => {
          const data = response.data;
          if (data.success) {
            // 登录成功，跳转到订单页面
            router.push('/order');
            console.log('登录成功');
          } else {
            // 登录失败，显示错误信息
            console.log('登录失败');
          }
        })
        .catch(error => {
          console.log(error);
        });
    };

    return {
      username,
      password,
      onSubmit
    };
  }
};
</script>