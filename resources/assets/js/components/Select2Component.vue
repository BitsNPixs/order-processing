<template>
    <select class="form-control" :data-placeholder="this.placeholder || 'Select a option'">
        <slot></slot>
      </select>
</template>

<script>
    export default {
        props: ["options", "value", "placeholder"],
        mounted: function() {
          let vm = this;
          let select2 = $(this.$el)
            // init select2
            .select2({ data: this.formatedOptions })
            .val(this.value)
            .trigger("change");

            select2.on('change.select2', function(){
                vm.$emit("input", this.value);
            })
        },
        computed: {
            formatedOptions : function(){
                return $.map(this.options, function (obj) {
                  obj.id = obj.id || obj.code;
                  obj.text = obj.text || obj.name;
                  return obj;
                });
            }
        },
        watch: {
          value: function(value) {
            // update value
            $(this.$el)
              .val(value)
              .trigger("change");
          },
          options: function(options) {
            // update options
            $(this.$el)
              .empty()
              .select2({ data: formatedOptions });
          }
        },
        destroyed: function() {
          $(this.$el)
            .off()
            .select2("destroy");
        }
    }
</script>