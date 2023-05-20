<template>
  <!-- 手机头部样式 -->
    <van-pull-refresh v-model="loading" :head-height="80" @refresh="onRefresh">

      <router-view />

      <van-row>
        <h1>&nbsp;</h1>
      </van-row>
      <van-row>
        <h1>&nbsp;</h1>
      </van-row>
      <van-row>
        <h1>&nbsp;</h1>
      </van-row>
      <van-row>
        <h1>&nbsp;</h1>
      </van-row>
      <van-row>
        <h1>&nbsp;</h1>
      </van-row>

    </van-pull-refresh>
</template>

<script>
import { ref } from 'vue';
import router from './router';
import { showToast } from 'vant';
import 'vant/es/pull-refresh/style'
import 'vant/es/tabbar/style'
import 'vant/es/tabbar-item/style'
import 'vant/es/config-provider/style'
import 'vant/es/row/style'
import 'vant/es/col/style'
import 'vant/es/icon/style'
import 'vant/es/image/style'
import 'vant/es/button/style'
import 'vant/es/field/style'


export default {
  setup() {
    const theme = ref('light');
    const dark = ref(false);
    const count = ref(0);
    const loading = ref(false);
    const active = ref(0);

    const icon = {
      active: 'https://fastly.jsdelivr.net/npm/@vant/assets/user-active.png',
      inactive:
        'https://fastly.jsdelivr.net/npm/@vant/assets/user-inactive.png',
    };

    const onRefresh = () => {
      setTimeout(() => {
        showToast('刷新成功');
        loading.value = false;
        count.value++;
      }, 1000);
    };

    setTimeout(() => {
      theme.value = 'dark';
      dark.value = true;
    }, 1000);

    return {
      icon,
      active,
      theme,
      dark,
      count,
      loading,
      onRefresh,
    };
  },
};
</script>

<style scoped>
.doge {
  width: 140px;
  height: 72px;
  margin-top: 8px;
  border-radius: 4px;
}
</style>