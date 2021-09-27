<template>
  <div class="row">
    <div class="col-lg-4 col-sm-12">
      <user-card :id="id" ></user-card>
    </div>
    <div class="col-lg-8 col-sm-12">
      <sent-message :receiverId="id" @pushMsg="addMessageInFront"></sent-message>
      <el-timeline id="disscussion" class="my-2" v-loading="loading">
        <message
          v-for="(msg, key) in Messages"
          :key="key"
          :Message="msg"
        ></message>
      </el-timeline>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Message from "./Message.vue";
import sentMessage from "./sentMessage.vue";
import userCard from "./userCard.vue";
export default {
  name: "discussion",
  props: {
    id: {
      type: Number,
      value: -1,
    },
  },
  components: {
    Message,
    sentMessage,
    userCard,
  },
  data() {
    return {
      newMessagesFromEcho:state.newMessages,
      Messages: [],
      loading: true,
    };
  },
  watch: {
    id() {
      this.load();
    },
    newMessagesFromEcho(newVal, oldVal){
      console.log(newVal[oldVal.length]);
    }
  },
  methods: {
    load() {
      this.Messages = [];
      this.loading = true;
      if (this.id != -1) {
        axios.get("/api/getDisscussion?withUserId=" + this.id).then((res) => {
          this.Messages = res.data;
          this.loading = false;
        });
      }
    },
    addMessageInFront(msg){
      this.Messages.unshift(msg);
    }
  },
  created() {
    this.load();
  },
};
</script>

<style>
#disscussion {
  overflow-y: scroll;
  height: 30rem;
  padding: 10px;
}
</style>