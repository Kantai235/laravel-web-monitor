<template>
  <div class="dashboard">
    <div class="server-list">
      <div
        class="server"
        v-for="(monitor, $index) in monitorList"
        :key="$index"
        v-bind:class="{ 'has-failed': monitor.ping === null }">
        <div class="server-icon fa" v-bind:class="{ 'fa-globe': monitor.ping !== null, 'fa-tasks': monitor.ping === null }"></div>
        <ul class="server-details">
          <li>
            Name:
            <span class="data">{{ monitor.name }}</span>
          </li>
          <li>
            Domain:
            <span class="data">{{ monitor.domain }}</span>
          </li>
          <li>
            Status:
            <span class="data signal" v-if="monitor.ping === null">Offline</span>
            <span class="data signal" v-else>Online</span>
          </li>
          <li>
            Address:
            <span class="data">{{ monitor.ip_address }}:{{ monitor.port }}</span>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "MonitorList",
  data() {
    return {
      monitorList: [],
    };
  },
  mounted() {
    axios
      .get("/api/monitor")
      .then((response) => {
        let monitor = response.data;
        this.monitorList.push(...monitor);
      })
      .catch((error) => console.log(error));
  },
};
</script>
