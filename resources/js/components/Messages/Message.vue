<template>
  <tr >
    <td >{{ Message.senderName }}</td>
    <td >{{ Message.receiverName }}</td>
    <td >{{ Message.date }}</td>
    <td >{{ Message.body }}</td>
  </tr>
</template>

<script>
import axios from "axios";
export default {
  name: "message",
  props: {
    id: {
      type: Number,
      value: -1,
    },
  },
  data() {
    return {
      Message: {
        //   senderName:'',
        //   receiverName:'',
        //   body:'',
        //   date:''
      },
    };
  },
  methods: {
    load() {
      if (this.id !== -1) {
        // console.log(this.id)
        axios.get("/api/messageDetails?id=" + this.id).then((res) => {
          this.Message = res.data;
        });
      }
    },
  },
  watch:{
    id(){
      this.load()
    }
  },
  created() {
    this.load()
  },
};
</script>

<style>
</style>