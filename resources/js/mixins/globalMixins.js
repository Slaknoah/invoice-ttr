export const permissions = {
    data() {
        return {
            //
        }
    },
};

export const utils = {
    methods: {
        $isEmptyObject(object) {
            return Object.entries(object).length === 0 && object.constructor === Object;
        },
        $isNullOrWhiteSpace(str) {
            return (!str || str.length === 0 || /^\s*$/.test(str))
        }, 
        $shortenText(text, numberOfStrings) {
            if(text)
                return text.replace(/(<([^>]+)>)/ig,"").substring(0, numberOfStrings) + ' ...';
            else
                return "";
        },
        $capitalizeText(str) {
            if(str && str.length)
                return  str.charAt(0).toUpperCase() + str.substring(1);
        },
        $formatDate(dateStr) {
            if(dateStr && dateStr.length) {
                var date = new Date(dateStr);
                return date.getDate() + '/' + (date.getMonth() + 1)+ '/' + date.getFullYear();
            }
        }
    },
    computed: {
        ROLES() {
            if(this.$store.getters.isLoggedIn) {
                if(!(this.$store.getters.getRoles.length)) {
                    this.$store.dispatch('fetchRoles').then(roles => {
                        return roles;
                    })
                }
                return this.$store.getters.getRoles;
            }
        },
        /**
         * @return {number}
         */
        MAX_UPLOAD_SIZE() {
            return parseInt( process.env.MIX_MAX_UPLOAD_SIZE )|| 3;
        },
        PERMISSIONS() {
            if(this.$store.getters.isLoggedIn) {
                if(!(this.$store.getters.getPermissions.length)) {
                    this.$store.dispatch('fetchPermissions').then(permissions => {
                        return permissions;
                    })
                }
                return this.$store.getters.getPermissions;
            }
        },
    },
};