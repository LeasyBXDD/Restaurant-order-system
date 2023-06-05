<template>
    <van-space direction="vertical" fill>
        <van-notice-bar color="#1989fa" background="#ecf9ff" left-icon="info-o" mode="closeable" scrollable>
            惊喜大酬宾！满1000减999！惊喜大酬宾！满1000减999！惊喜大酬宾！满1000减999！惊喜大酬宾！满1000减999！
        </van-notice-bar>
        <van-row justify="center">
            <!-- 欢迎光临 -->
            <h1>欢迎光临</h1>
        </van-row>
        <van-row justify="center">
            <h5>简单两步，即可注册</h5>
        </van-row>
        <van-row style="margin-bottom: 10px;"></van-row>
        <van-form @submit="onSubmit">
            <van-cell-group inset>
                <van-field v-model="username" name="username" label="电话" placeholder="电话"
                    :rules="[{ required: true, message: '请填写电话号码' }]" />
                <van-field v-model="password" type="password" name="password" label="密码" placeholder="密码"
                    :rules="[{ required: true, message: '请填写密码' }]" />
            </van-cell-group>
            <div style="margin: 16px;">
                <van-button round block type="default" native-type="submit" @click="registerBtn">
                    注册
                </van-button>
            </div>
        </van-form>
    </van-space>
</template>
  
<script>
import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";
import { showToast } from "vant";
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


export default {
    setup() {
        const router = useRouter();
        const username = ref("");
        const password = ref("");

        return {
            username,
            password,
        };
    },
    methods: {
        registerBtn() {
            this.$router.push("/");
        },
        onSubmit(event) {
            event.preventDefault();
            const formData = new FormData(event.currentTarget);
            const data = {};
            for (const [key, value] of formData.entries()) {
                data[key] = value;
            }
            axios
                .post("http://localhost/wen20230105/php/register.php", data)
                .then((res) => {
                    Toast.success("注册成功");
                    this.$router.push("/");
                })
                .catch((err) => {
                    console.log("注册失败", err);
                });
        },
    },
};
</script>
  
<style scoped></style>