<template>

  <van-row justify="center">
    <h1>修改密码</h1>
  </van-row>
  <van-row justify="center">
    <h5>&nbsp;</h5>
  </van-row>
  <van-form @submit="onSubmit">
    <van-field v-model="phone" name="phone" label="电话号码" placeholder="请输入电话号码"
      :rules="[{ required: true, message: '请输入电话号码' }, { pattern: /^1\d{10}$/, message: '请输入正确的电话号码' }]" />
    <van-field v-model="code" name="code" label="验证码" placeholder="请输入验证码"
      :rules="[{ required: true, message: '请输入验证码' }]">
      <template #button>
        <van-button type="primary" size="small" :disabled="codeBtnDisabled" @click="sendCode">{{ codeBtnText
        }}</van-button>
      </template>
    </van-field>
    <van-field v-model="newPassword" name="newPassword" label="新密码" type="password" placeholder="请输入新密码"
      :rules="[{ required: true, message: '请输入新密码' }, { min: 6, message: '密码长度不能少于6位' }]" />
    <van-field v-model="confirmPassword" name="confirmPassword" label="确认密码" type="password" placeholder="请再次输入新密码"
      :rules="[{ required: true, message: '请再次输入新密码' }, { validator: validateConfirmPassword, message: '两次输入的密码不一致' }]" />
    <van-button type="primary" block native-type="submit" style="margin: 10px;">提交</van-button>
  </van-form>
</template>

<script>
import { ref } from 'vue';
import 'vant/es/notify/style'
import 'vant/es/field/style'
import 'vant/es/button/style'
import 'vant/es/cell-group/style'
import 'vant/es/cell/style'
import 'vant/es/form/style'
import 'vant/es/row/style'
import 'vant/es/col/style'
import 'vant/es/notice-bar/style'
import 'vant/es/image/style'
import 'vant/es/toast/style'
import { Form, Field, Button, Toast, showSuccessToast, showFailToast } from 'vant';



export default {
  components: {
    VanForm: Form,
    VanField: Field,
    VanButton: Button,
  },
  setup() {
    const phone = ref('');
    const code = ref('');
    const newPassword = ref('');
    const confirmPassword = ref('');
    const codeBtnText = ref('获取验证码');
    const codeBtnDisabled = ref(false);

    const sendCode = () => {
      // 发送验证码逻辑
      showSuccessToast('验证码已发送');
      codeBtnDisabled.value = true;
      let count = 60;
      const timer = setInterval(() => {
        count--;
        if (count <= 0) {
          clearInterval(timer);
          codeBtnText.value = '获取验证码';
          codeBtnDisabled.value = false;
        } else {
          codeBtnText.value = `${count} 秒后重发`;
        }
      }, 1000);
    };

    const validateConfirmPassword = (value) => {
      return value === newPassword.value;
    };

    const onSubmit = (values) => {
      console.log('submit', values);
    };

    return {
      phone,
      code,
      newPassword,
      confirmPassword,
      codeBtnText,
      codeBtnDisabled,
      sendCode,
      validateConfirmPassword,
      onSubmit,
    };
  },
};
</script>