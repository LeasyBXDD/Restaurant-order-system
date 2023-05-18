<template>
    <van-swipe-cell>
        <van-card num="2" price="2.00" desc="描述信息" title="商品标题" class="goods-card"
            thumb="https://fastly.jsdelivr.net/npm/@vant/assets/cat.jpeg" />
        <template #right>
            <van-button square text="删除" type="danger" class="delete-button" />
        </template>
    </van-swipe-cell>
    <van-swipe-cell>
        <van-card num="2" price="2.00" desc="描述信息" title="商品标题" class="goods-card"
            thumb="https://fastly.jsdelivr.net/npm/@vant/assets/cat.jpeg" />
        <template #right>
            <van-button square text="删除" type="danger" class="delete-button" />
        </template>
    </van-swipe-cell>
    <van-swipe-cell>
        <van-card num="2" price="2.00" desc="描述信息" title="商品标题" class="goods-card"
            thumb="https://fastly.jsdelivr.net/npm/@vant/assets/cat.jpeg" />
        <template #right>
            <van-button square text="删除" type="danger" class="delete-button" />
        </template>
    </van-swipe-cell>
    <van-swipe-cell>
        <van-card num="2" price="2.00" desc="描述信息" title="商品标题" class="goods-card"
            thumb="https://fastly.jsdelivr.net/npm/@vant/assets/cat.jpeg" />
        <template #right>
            <van-button square text="删除" type="danger" class="delete-button" />
        </template>
    </van-swipe-cell>
    <van-swipe-cell>
        <van-card num="2" price="2.00" desc="描述信息" title="商品标题" class="goods-card"
            thumb="https://fastly.jsdelivr.net/npm/@vant/assets/cat.jpeg" />
        <template #right>
            <van-button square text="删除" type="danger" class="delete-button" />
        </template>
    </van-swipe-cell>
    <van-swipe-cell>
        <van-card num="2" price="2.00" desc="描述信息" title="商品标题" class="goods-card"
            thumb="https://fastly.jsdelivr.net/npm/@vant/assets/cat.jpeg" />
        <template #right>
            <van-button square text="删除" type="danger" class="delete-button" />
        </template>
    </van-swipe-cell>
    <van-swipe-cell>
        <van-card num="2" price="2.00" desc="描述信息" title="商品标题" class="goods-card"
            thumb="https://fastly.jsdelivr.net/npm/@vant/assets/cat.jpeg" />
        <template #right>
            <van-button square text="删除" type="danger" class="delete-button" />
        </template>
    </van-swipe-cell>
</template>

<script>
import { ref } from 'vue';
import router from './router';
import { showToast } from 'vant';
import 'vant/es/pull-refresh/style'
import 'vant/es/tabbar/style'
import 'vant/es/tabbar-item/style'
import 'vant/es/config-provider/style'

export default {
    setup() {
        const theme = ref('light');
        const dark = ref(false);
        const count = ref(0);
        const loading = ref(false);
        const active = ref(0);

        const icon = {
            active: 'https://fastly.jsdelivr.net/npm/@vant/assets/user-active.png',
            inactive: 'https://fastly.jsdelivr.net/npm/@vant/assets/user'
        };

        const onRefresh = () => {
            loading.value = true;
            setTimeout(() => {
                loading.value = false;
                count.value += 1;
            }, 1000);
        };

        const onChange = (index) => {
            showToast(`切换到标签 ${index + 1}`);
        };

        return {
            theme,
            dark,
            count,
            loading,
            active,
            icon,
            onRefresh,
            onChange
        };
    }
};
</script>
<style>
.goods-card {
    margin: 0;
    background-color: white;
}

.delete-button {
    height: 100%;
}
</style>