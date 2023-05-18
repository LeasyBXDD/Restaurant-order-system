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
            <h5>点餐前请先登录</h5>
        </van-row>
        <van-row justify="center">
            <van-image round width="6rem" height="6rem" src="https://fastly.jsdelivr.net/npm/@vant/assets/cat.jpeg" />
        </van-row>
        <van-form @submit="onSubmit">
            <van-cell-group inset>
                <van-field v-model="username" name="电话" label="电话" placeholder="电话"
                    :rules="[{ required: true, message: '请填写电话号码' }]" />
                <van-field v-model="password" type="password" name="密码" label="密码" placeholder="密码"
                    :rules="[{ required: true, message: '请填写密码' }]" />
            </van-cell-group>
            <div style="margin: 16px;">
                <van-button round block type="primary" to="/order">
                    登录
                </van-button>
            </div>
            <div style="margin: 16px;">
                <van-button round block type="default" to="register">
                    注册
                </van-button>
            </div>
            <!-- 忘记密码 -->
            <van-row justify="end">
                <van-col span="8">
                    <router-link to="/forget" style="color:#1989fa;">忘记密码</router-link>
                </van-col>
            </van-row>
        </van-form>
    </van-space>
</template>

<script>
import { ref, reactive } from 'vue';
import router from '../router';
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
        const username = ref('');
        const password = ref('');
        const onSubmit = (values) => {
            console.log('submit', values);
        };

        return {
            username,
            password,
            onSubmit,
        };
    },
    methods: {

    }
};


</script>

<style scoped></style>