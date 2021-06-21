var jQ=jQuery.noConflict();

(function(jQ) {
    jQ.fn.optwidth = function(options) {
    var opts = jQ.extend({}, jQ.fn.optwidth.defaults, options);
    if (opts.debug) { console.log('fso debug mode'); }
    return this.each(function() {
        var $this = jQ(this);
        $this.each(function(index){
            var pleft = parseInt(jQ(this).parent().css('padding-left'));
            var pright = parseInt(jQ(this).parent().css('padding-right'));
            var eleft = parseInt(jQ(this).css('padding-left'));
            var eright = parseInt(jQ(this).css('padding-right'));
            pw = jQ(this).parent().innerWidth()-pleft-pright-eleft-eright;
            pdisp = jQ(this).parent().css('display');
            pwidth = jQ(this).parent().css('width');
			disp = jQ(this).css('display');
            word_wrap = jQ(this).css('word-wrap');
            word_break = jQ(this).css('word-break');
            white_space = jQ(this).css('white-space');
            hyphens = jQ(this).css('hyphens');
            jQ(this).css('display','inline');
            jQ(this).css('word-wrap','normal');
            jQ(this).css('word-break','normal');
            jQ(this).css('hyphens','none');
            if (opts.ub=='line') {
            	jQ(this).css('white-space','nowrap');
            	if (opts.debug) { console.log('line'); }
            	}
            else if (opts.ub=='wordline'){
            	if (opts.debug) { console.log('wordline'); }
	            var wltext = jQ(this).text();
				var wlsplit = wltext.split(" ");	            
	            var a = 0;
	            var newarray = new Array(wlsplit[0]);
	            var wlarray = new Array(wlsplit[0]);
	            for (i=0;i<(wlsplit.length-1);i++) {
	            	newstring = newarray[a] + ' ' + wlsplit[(i+1)];
	            	if (newstring.length<opts.wl) {
	            		newarray[a] = newarray[a] + ' ' + wlsplit[(i+1)];
	            		wlarray[a] = wlarray[a] + '&nbsp;' + wlsplit[(i+1)];
	            		}
	            	else {
	            		a++;
	            		newarray[a] = wlsplit[(i+1)];
	            		wlarray[a] = wlsplit[(i+1)];
	            		} 
	            	}
	            var wloutput = wlarray.join (" ");  
	            jQ(this).html(wloutput);
	            }
	        else {
	        	if (opts.debug) { console.log('word'); }
	        	}
            hb = jQ(this).outerWidth();
            if (hb>pw) {
                i = pw;
				
				jQ(this).children().css('font-size','inherit');
                thiscontent = jQ(this).html();
                jQ(this).html(jQ(this).text());
                fsint = parseInt(jQ(this).css('font-size'));
                
                if (opts.debug) { 
                	console.log('got element font size ' + fsint + 'px');
                	console.log('got element width ' + hb + 'px for calculating');
                	console.log('got container width ' + pw + 'px for calculating');
                	}
                
                calcsize = (fsint*pw)/hb;
                if (calcsize<opts.ms) { calcsize = opts.ms; }
                jQ(this).css('font-size', Math.round(calcsize,0)+'px');
                
				if (opts.debug) { 
                	console.log('calculated element font size ' + Math.round(calcsize,0) + 'px');
                	}
                
                jQ(this).html(thiscontent); jQ(this).addClass(opts.mc);
                if (opts.sl){
					jQ(this).css('line-height', calcsize + 'px')
					}
                }
			
			if(opts.uo) {
				var olmax = 0; 
					var oltext = jQ(this).text();
					var olsplit = oltext.split(" ");
					var olsplitl = olsplit.length;
				for (var r = 0; r < olsplitl; r++){
					ol = olsplit[r].length;
					if (ol > olmax){
						olmax = ol;
						}
				if (opts.ub=='word'){
					var a = 0;
	           		var newarray = new Array(olsplit[0]);
	            	var olarray = new Array(olsplit[0]);
					for (var i=0;i<(olsplit.length-1);i++) {
		            	newstring = newarray[a] + ' ' + olsplit[(i+1)];
		            	if (newstring.length<olmax) {
		            		newarray[a] = newarray[a] + ' ' + olsplit[(i+1)];
		            		olarray[a] = olarray[a] + '&nbsp;' +olsplit[(i+1)];
		            		}
		            	else {
		            		a++;
		            		newarray[a] = olsplit[(i+1)];
		            		olarray[a] = olsplit[(i+1)];
		            		} 
	            		} 
					}
				else if (opts.ub=='wordline'){
					olarray = olsplit;
					}
				var oloutput = '<span class="oline">' + olarray.join('</span> <span class="oline">') + '</span>';
				jQ(this).html(oloutput);

				var fsint = 0;
				jQ('.oline').each(function(e){
					spw = Math.round(jQ(this).innerWidth(),0);
					fsint = parseInt(jQ(this).css('font-size'));
					while (spw<pw){
						jQ(this).css('font-size',(fsint+1)+'px');
						fsint = parseInt(jQ(this).css('font-size'));
						spw = Math.round(jQ(this).innerWidth(),0);
						}
					jQ(this).addClass('ospan-' + e).css('display','block').css('width','100%').css('text-align','justify');
					if (opts.sl){
							jQ(this).css('line-height', fsint + 'px')
							}
						
						});
				jQ('.oline').removeClass('oline');
				}
			}
			
			jQ(this).css('display',disp);
			jQ(this).css('word-wrap',word_wrap);
			jQ(this).css('word-break',word_break);
			jQ(this).css('white-space',white_space);
			jQ(this).css('hyphens',hyphens);
			
		});
    });
    
}
jQ.fn.optwidth.defaults = {
	debug: false, // debug mode
	mc: 'optwidth', // klasse des geänderten elements
	ms: 0, // minimum font-size
	ub: 'word', // minimalisation auf 'word', 'line', 'wordline'
	wl: 70, // zeichen in einer reihe 
	uo: false, // worte auf breite bringen
	sl: false // zeilen eng zusammenfassen
	};
})(jQuery)