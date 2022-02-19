<template>
  <div class="py-6">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
      <form @submit.prevent="postTweet">
        <textarea
          ref="tweetTextarea"
          @input="resizeTweetTextarea"
          placeholder="What's happening ?"
          class="
            rounded-lg
            border border-gray-200
            w-full
            p-2
            font-semibold
            resize-none
            focus:outline-none
          "
          v-model="content"
        ></textarea>

        <div v-if="$page.props.user.is_admin == 1">
          <label><strong>Tweet as :</strong></label>
          <select class="form-control" :required="true">
            <option
              v-for="user in users"
              @click="selectUser(user)"
              v-bind:key="user.id"
              v-bind:value="user.id"
              :selected="user"
            >
              {{ user.name }}
            </option>
          </select>
        </div>
        <div class="flex items-center space-x-4 justify-end mt-3">
          <p
            class="text-sm text-gray-400 font-thin"
            :class="{ 'text-red-500': calculateRemainingChar < 0 }"
          >
            {{ calculateRemainingChar }} remaining caracters
          </p>
          <button-vue
            :disabled="!canSubmit"
            class="bg-blue-500 hover:bg-blue-800 rounded-full font-extrabold"
            >Tweet</button-vue
          >
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import Button from "../../Jetstream/Button.vue";
import vSelect from "vue-select";

export default {
  components: { ButtonVue: Button, vSelect },
  data() {
    return {
      content: "",
      maxChar: 281,
      users: [],
      vSelectUser: null,
    };
  },
  methods: {
    postTweet() {
      console.log("this.selected", this.selected);
      this.$inertia.post(
        "/tweets",
        {
          content: this.content,
          user_id: this.selected ? this.selected : null,
        },
        { preserveState: false }
      );
    },

    getUsers() {
      var vm = this;

      axios
        .get("/users")
        .then(function (response) {
          console.log(response);
          vm.users = response.data.map((el) => {
            return { name: el.name, id: el.id };
          });
          console.log("vm.users", vm.users);
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    selectUser(user) {
      console.log("user", user);
      this.selectUser = user.id;
    },
    resizeTweetTextarea() {
      let textarea = this.$refs["tweetTextarea"];
      textarea.style.height = "initial";
      textarea.style.height = `${textarea.scrollHeight}px`;
    },
  },
  computed: {
    calculateRemainingChar() {
      return this.maxChar - this.content.length;
    },
    canSubmit() {
      return this.content.length && this.calculateRemainingChar >= 0;
    },
  },
  created() {
    this.getUsers();
  },
};
</script>

<style scoped>
button:disabled {
  opacity: 50%;
  cursor: not-allowed;
}
</style>
