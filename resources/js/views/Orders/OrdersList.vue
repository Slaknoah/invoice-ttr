<template>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col s12 m6 l6">
                    <h4 class="title">{{ $t('orders.title') }}</h4>
                </div>
                <div class="col s12 m6 l6 right-align-md">
                    <BaseBreadcrumb/>
                </div>
            </div>
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
                            <TouristLoading/>
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