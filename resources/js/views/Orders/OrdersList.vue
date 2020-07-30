<template>
    <div class="content">
        <div class="container">
        </div>
        <div class="container frame">
            <table class="editable">
                <thead>
                <tr>
                    <th>{{ $t('orders.name') }}</th>
                    <th>{{ $t('orders.phone') }}</th>
                    <th>{{ $t('orders.email') }}</th>
                    <th>{{ $t('orders.note') }}</th>
                    <th style="width:50px"></th>
                </tr>
                </thead>

                <transition name="fade" mode="out-in">
                    <tbody  class="loading">
                    <tr >
                        <td colspan="5">
                        </td>
                    </tr>
                    </tbody>
                </transition>
            </table>
        </div>
    </div>
</template>

<script>

</script>

<style scoped>

</style>