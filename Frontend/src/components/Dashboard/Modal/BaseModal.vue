<template>
  <Teleport to="body">
      <div v-if="modal.isOpen" class="modal">
        <div class="modal-content">
          <div class="title" v-if="$slots.title">
            <slot name="title" />
            <button type="button" class="close" @click="modal.closeDelete()">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="content">
            <slot name="body"/>
          </div>
          <div class="action d-flex justify-content-end">
              <slot name="action"/>
          </div>
        </div>
      </div>
      
  </Teleport>
   
</template>
<script>
import {useModal} from "../../../state/Modal"
export default {
  setup() {
    const modal = useModal();
    return { modal }
  }
}
</script>


<style scoped>
.modal {
  position: fixed;
  left: 0;
  top: 0;
  right: 0;
  bottom: 0;
  z-index: 1031;
  background-color: rgba(167, 163, 163, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
}
.modal-content {
  flex-basis: 600px;
  padding: 10px;
  background-color: white;
  border-radius: 4px;
  
}
.title {
  margin-bottom: 0;
  font-weight: 500;
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  padding: 1rem;
  align-items: center;
}
.close {
  padding: 1rem;
  margin: -1rem -1rem -1rem auto;
  background-color: transparent;
  border: 0;
  cursor: pointer;
  font-size:1.5rem;
}
.content{
  padding: 1rem;
  border-top: 1px solid #e9ecef;
  border-bottom: 1px solid #e9ecef;
}
.action{
  padding: 1rem;
}
</style>