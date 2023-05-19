<template>
    <van-cell v-for="item in list" :key="item" :title="item" />
    <van-back-top bottom="150px"/>

    <van-search v-model="value" placeholder="请输入搜索关键词" />
    <van-notice-bar left-icon="volume-o" text="无论我们能活多久，我们能够享受的只有无法分割的此刻，此外别无其他。" />
    <van-row>
        <h5>&nbsp;</h5>
    </van-row>
    <van-row>
        <div style="width: 100%;">
            <van-card v-for="(item, index) in goodsList" :key="index" :num="item.num" :price="item.price" :desc="item.desc"
                :title="item.title" :thumb="item.thumb" >

                <template #tags>
                    <van-tag v-for="(tag, tagIndex) in item.tags" :key="tagIndex" plain type="primary">{{ tag }}</van-tag>
                </template>
                <template #footer>
                    <van-button v-for="(button, buttonIndex) in item.buttons" :key="buttonIndex" size="mini">
                        {{ button }}
                    </van-button>

                </template>
            </van-card>
        </div>

        <!-- <van-col span="8">
            <van-sidebar v-model="active">
                <van-sidebar-item title="来点蔬菜" index="1" />
                <van-sidebar-item title="大口吃肉" index="2" />
                <van-sidebar-item title="必点碳水" index="3" />
                <van-sidebar-item title="美味饮品" index="4" />
            </van-sidebar>
        </van-col>
        <van-col span="16"> -->

        <!-- </van-col> -->

        <!-- <van-tree-select v-model:active-id="activeIds" v-model:main-active-index="activeIndex" :items="items" /> -->

    </van-row>

    <van-submit-bar :price="3050" button-text="提交订单" @submit="onSubmit" style="margin-bottom: 50px;">
        <van-checkbox v-model="checked">全选</van-checkbox>
    </van-submit-bar>

    <van-tabbar v-model="active" route>
        <van-tabbar-item replace to="/order">
            <span>点餐</span>
            <template #icon="props">
                <img :src="props.active ? icon.active : icon.inactive" />
            </template>
        </van-tabbar-item>
        <van-tabbar-item icon="search" replace to="/">登录</van-tabbar-item>
        <van-tabbar-item icon="setting-o" replace to="/forget">忘记</van-tabbar-item>
    </van-tabbar>
</template>

<script>
import { ref } from 'vue';
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
import 'vant/es/search/style'
import 'vant/es/notice-bar/style'
import 'vant/es/sidebar/style'
import 'vant/es/sidebar-item/style'
import 'vant/es/toast/style'
import 'vant/es/action-bar/style'
import 'vant/es/action-bar-icon/style'
import 'vant/es/action-bar-button/style'
import 'vant/es/submit-bar/style'
import 'vant/es/checkbox/style'
import 'vant/es/checkbox-group/style'
import 'vant/es/stepper/style'
import 'vant/es/swipe-cell/style'
import 'vant/es/card/style'
import 'vant/es/tag/style'
import 'vant/es/tree-select/style'
import 'vant/es/back-top/style'


export default {
    setup() {
        const value = ref('');
        const active = ref(0);
        const activeId = ref([1, 2]);
        const activeIndex = ref(0);

        const items = [
            {
                text: '浙江',
                children: [
                    { text: '杭州', id: 1 },
                    { text: '温州', id: 2 },
                    { text: '宁波', id: 3, disabled: true },
                ],
            },
            {
                text: '江苏',
                children: [
                    { text: '南京', id: 4 },
                    { text: '无锡', id: 5 },
                    { text: '徐州', id: 6 },
                ],
            },
            { text: '福建', disabled: true },
        ];
        const list = [...Array(50).keys()];
        const icon = {
            active: 'https://fastly.jsdelivr.net/npm/@vant/assets/user-active.png',
            inactive:
                'https://fastly.jsdelivr.net/npm/@vant/assets/user-inactive.png',
        };

        const onChange = (index) => {
            router.push(`/order/${index}`);
            console.log(index);
        };

        return {
            items,
            activeId,
            activeIndex,
            icon,
            active,
            value,
            onChange,
            list,

        };
    },
    data() {
        return {
            goodsList: [
                {
                    num: 2,
                    price: 2.0,
                    desc: '描述信息',
                    title: '商品标题',
                    thumb: 'https://fastly.jsdelivr.net/npm/@vant/assets/ipad.jpeg',
                    tags: ['标签1', '标签2'],
                    buttons: ['按钮1', '按钮2'],
                },
                // 其他商品数据
                {
                    num: 2,
                    price: 2.0,
                    desc: '描述信息',
                    title: '商品标题',
                    thumb: 'https://fastly.jsdelivr.net/npm/@vant/assets/ipad.jpeg',
                    tags: ['标签1', '标签2'],
                    buttons: ['按钮1', '按钮2'],
                },
                {
                    num: 2,
                    price: 2.0,
                    desc: '描述信息',
                    title: '商品标题',
                    thumb: 'https://fastly.jsdelivr.net/npm/@vant/assets/ipad.jpeg',
                    tags: ['标签1', '标签2'],
                    buttons: ['按钮1', '按钮2'],
                },
                {
                    num: 2,
                    price: 2.0,
                    desc: '描述信息',
                    title: '商品标题',
                    thumb: 'https://fastly.jsdelivr.net/npm/@vant/assets/ipad.jpeg',
                    tags: ['标签1', '标签2'],
                    buttons: ['按钮1', '按钮2'],
                },
                {
                    num: 2,
                    price: 2.0,
                    desc: '描述信息',
                    title: '商品标题',
                    thumb: 'https://fastly.jsdelivr.net/npm/@vant/assets/ipad.jpeg',
                    tags: ['标签1', '标签2'],
                    buttons: ['按钮1', '按钮2'],
                },
                {
                    num: 2,
                    price: 2.0,
                    desc: '描述信息',
                    title: '商品标题',
                    thumb: 'https://fastly.jsdelivr.net/npm/@vant/assets/ipad.jpeg',
                    tags: ['标签1', '标签2'],
                    buttons: ['按钮1', '按钮2'],
                },
                {
                    num: 2,
                    price: 2.0,
                    desc: '描述信息',
                    title: '商品标题',
                    thumb: 'https://fastly.jsdelivr.net/npm/@vant/assets/ipad.jpeg',
                    tags: ['标签1', '标签2'],
                    buttons: ['按钮1', '按钮2'],
                },
                {
                    num: 2,
                    price: 2.0,
                    desc: '描述信息',
                    title: '商品标题',
                    thumb: 'https://fastly.jsdelivr.net/npm/@vant/assets/ipad.jpeg',
                    tags: ['标签1', '标签2'],
                    buttons: ['按钮1', '按钮2'],
                },
            ],
        };
    },
};
</script>