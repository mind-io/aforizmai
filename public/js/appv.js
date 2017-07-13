new Vue({
	el: '#app',
	data: {
		counter: 0,
		secondCounter: 0
	},
	computed: {
		output: function() {
			console.log('Computed');
			return this.counter > 5 ? 'Greater than 5' : 'Smaller than 5';
		}
	},
	methods: {
		result: function() {
			console.log('Method');
			return this.counter > 5 ? 'Greater than 5' : 'Smaller than 5';
		}
	},
	watch: {
		counter: function(value) {
			var vm = this;
			setTimeout(function() {
				vm.counter = 0;
			}, 2000);
		}
	}
});

new Vue({
	el: '#exercise',
	data: {
		value: 0
	},
	computed: {
		result: function() {
			return this.value > 37 ? 'done 37' : 'not there yet';
		}
	},
	watch: {
		result: function() {
			var vm = this;
			setTimeout(function() {
				vm.value = 0;
			}, 3000);
		}
	}

});

new Vue({
	el: '#likes',
	data: {
    	likeHover: false,
    	dislikeHover: false,
    	counterBadge: 25
    },
    computed: {
  		mouseOnLike() {
	    	return {
		    	"fa-thumbs-up": this.likeHover,
	      	 	"fa-thumbs-o-up": !this.likeHover,
    	    };
    	},
  		mouseOnDislike() {
	    	return {
		    	"fa-thumbs-down": this.dislikeHover,
	      	 	"fa-thumbs-o-down": !this.dislikeHover,
    	    };
    	}
    },
    methods: {
	    mouseOverLike: function(event) {
	        this.likeHover = true;
	    },
	    mouseLeaveLike: function(event) {
	        this.likeHover = false;
	    },
	    mouseOverDislike: function(event) {
	        this.dislikeHover = true;
	    },
	    mouseLeaveDislike: function(event) {
	        this.dislikeHover = false;
	    }

	}
});
