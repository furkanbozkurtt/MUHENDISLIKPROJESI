 
  

//***********************************************************************************************************************************/
Array.prototype.removeDuplicates = function () { for (var i = 1; i < this.length; i++) { if (this[i][0] == this[i-1][0]) { this.splice(i,1); } } }
Array.prototype.empty = function () { for (var i = 0; i <= this.length; i++) { this.shift(); } }
String.prototype.trim = function () { return this.replace(/^\s+|\s+$/g, ''); }

function LyteBox() {
  /*** Start Global Configuration ***/
    this.theme        = 'grey'; // themes: grey (default), red, green, blue, gold
    this.hideFlash      = true;   // controls whether or not Flash objects should be hidden
    this.outerBorder    = true;   // controls whether to show the outer grey (or theme) border
    this.resizeSpeed    = 8;    // controls the speed of the image resizing (1=slowest and 10=fastest)
    this.maxOpacity     = 80;   // higher opacity = darker overlay, lower opacity = lighter overlay
    this.navType      = 1;    // 1 = "Prev/Next" buttons on top left and left (default), 2 = "<< prev | next >>" links next to image number
    this.autoResize     = true;   // controls whether or not images should be resized if larger than the browser window dimensions
    this.doAnimations   = true;   // controls whether or not "animate" Lytebox, i.e. resize transition between images, fade in/out effects, etc.
    
    this.borderSize     = 12;   // if you adjust the padding in the CSS, you will need to update this variable -- otherwise, leave this alone...
  /*** End Global Configuration ***/
  
  /*** Configure Slideshow Options ***/
    this.slideInterval    = (typeof (slideShowInterval) != 'undefined' ? slideShowInterval : 4000); // Change value (milliseconds) to increase/decrease the time between "slides" (10000 = 10 seconds)
    this.showNavigation   = true;   // true to display Next/Prev buttons/text during slideshow, false to hide
    this.showClose      = true;   // true to display the Close button, false to hide
    this.showDetails    = true;   // true to display image details (caption, count), false to hide
    this.showPlayPause    = true;   // true to display pause/play buttons next to close button, false to hide
    this.autoEnd      = true;   // true to automatically close Lytebox after the last image is reached, false to keep open
    this.pauseOnNextClick = false;  // true to pause the slideshow when the "Next" button is clicked
          // true to pause the slideshow when the "Prev" button is clicked
  /*** End Slideshow Configuration ***/
  
  if(this.resizeSpeed > 10) { this.resizeSpeed = 10; }
  if(this.resizeSpeed < 1) { resizeSpeed = 1; }
  this.resizeDuration = (11 - this.resizeSpeed) * 0.15;
  this.resizeWTimerArray    = new Array();
  this.resizeWTimerCount    = 0;
  this.resizeHTimerArray    = new Array();
  this.resizeHTimerCount    = 0;
  this.showContentTimerArray  = new Array();
  this.showContentTimerCount  = 0;
  this.overlayTimerArray    = new Array();
  this.overlayTimerCount    = 0;
  this.imageTimerArray    = new Array();
  this.imageTimerCount    = 0;
  this.timerIDArray     = new Array();
  this.timerIDCount     = 0;
  this.slideshowIDArray   = new Array();
  this.slideshowIDCount   = 0;
  this.imageArray  = new Array();
  this.activeImage = null;
  this.slideArray  = new Array();
  this.activeSlide = null;
  this.frameArray  = new Array();
  this.activeFrame = null;
  this.checkFrame();
  this.isSlideshow = false;
  this.isLyteframe = false;
  /*@cc_on
    /*@if (@_jscript)
      this.ie = (document.all && !window.opera) ? true : false;
    /*@else @*/
      this.ie = false;
    /*@end
  @*/
  function getInternetExplorerVersion() {
      var rv = -1; // Return value assumes failure.
      if (navigator.appName == 'Microsoft Internet Explorer') {
          var ua = navigator.userAgent;
          var re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
          if (re.exec(ua) != null)
              rv = parseFloat(RegExp.$1);
      }
      return rv;
  }
  this.ie7 = (this.ie && window.XMLHttpRequest);
    this.ie8plus = (this.ie && getInternetExplorerVersion() >= 8);  
  this.initialize();
}

LyteBox.prototype.initialize = function() {
  this.updateLyteboxItems();
  var objBody = this.doc.getElementsByTagName("body").item(0);  
  if (this.doc.getElementById('lb_lbOverlay')) {
    objBody.removeChild(this.doc.getElementById("lb_lbOverlay"));
    objBody.removeChild(this.doc.getElementById("lb_lbMain"));
  }
  var objOverlay = this.doc.createElement("div");
    objOverlay.setAttribute('id','lb_lbOverlay');
    objOverlay.className = this.theme;
    if ((this.ie && !this.ie7) || (this.ie7 && this.doc.compatMode == 'BackCompat')) {
      objOverlay.style.position = 'absolute';
    }
    objOverlay.style.display = 'none';
    objBody.appendChild(objOverlay);
  var objLytebox = this.doc.createElement("div");
    objLytebox.setAttribute('id','lb_lbMain');
    objLytebox.style.display = 'none';
    objBody.appendChild(objLytebox);
  var objOuterContainer = this.doc.createElement("div");
    objOuterContainer.setAttribute('id','lb_lbOuterContainer');
    objOuterContainer.className = this.theme;
    objLytebox.appendChild(objOuterContainer);
  var objIframeContainer = this.doc.createElement("div");
    objIframeContainer.setAttribute('id','lb_lbIframeContainer');
    objIframeContainer.style.display = 'none';
    objOuterContainer.appendChild(objIframeContainer);
  var objIframe = this.doc.createElement("iframe");
    objIframe.setAttribute('id','lb_lbIframe');
    objIframe.setAttribute('name','lb_lbIframe');
    objIframe.style.display = 'none';
    objIframeContainer.appendChild(objIframe);
  var objImageContainer = this.doc.createElement("div");
    objImageContainer.setAttribute('id','lb_lbImageContainer');
    objOuterContainer.appendChild(objImageContainer);
  var objLyteboxImage = this.doc.createElement("img");
    objLyteboxImage.setAttribute('id','lb_lbImage');
    objImageContainer.appendChild(objLyteboxImage);
  var objLoading = this.doc.createElement("div");
    objLoading.setAttribute('id','lb_lbLoading');
    objOuterContainer.appendChild(objLoading);
  var objDetailsContainer = this.doc.createElement("div");
    objDetailsContainer.setAttribute('id','lb_lbDetailsContainer');
    objDetailsContainer.className = this.theme;
    objLytebox.appendChild(objDetailsContainer);
  var objDetailsData =this.doc.createElement("div");
    objDetailsData.setAttribute('id','lb_lbDetailsData');
    objDetailsData.className = this.theme;
    objDetailsContainer.appendChild(objDetailsData);
  var objDetails = this.doc.createElement("div");
    objDetails.setAttribute('id','lb_lbDetails');
    objDetailsData.appendChild(objDetails);
  var objCaption = this.doc.createElement("span");
    objCaption.setAttribute('id','lb_lbCaption');
    objDetails.appendChild(objCaption);
  var objHoverNav = this.doc.createElement("div");
    objHoverNav.setAttribute('id','lb_lbHoverNav');
    objImageContainer.appendChild(objHoverNav);
  var objBottomNav = this.doc.createElement("div");
    objBottomNav.setAttribute('id','lb_lbBottomNav');
    objDetailsData.appendChild(objBottomNav);
  var objPrev = this.doc.createElement("a");
    objPrev.setAttribute('id','lb_lbPrev');
    objPrev.className = this.theme;
    objPrev.setAttribute('href','#');
    objHoverNav.appendChild(objPrev);
  var objNext = this.doc.createElement("a");
    objNext.setAttribute('id','lb_lbNext');
    objNext.className = this.theme;
    objNext.setAttribute('href','#');
    objHoverNav.appendChild(objNext);
  var objNumberDisplay = this.doc.createElement("span");
    objNumberDisplay.setAttribute('id','lb_lbNumberDisplay');
    objDetails.appendChild(objNumberDisplay);
  var objNavDisplay = this.doc.createElement("span");
    objNavDisplay.setAttribute('id','lb_lbNavDisplay');
    objNavDisplay.style.display = 'none';
    objDetails.appendChild(objNavDisplay);
  var objClose = this.doc.createElement("a");
    objClose.setAttribute('id','lb_lbClose');
    objClose.className = this.theme;
    objClose.setAttribute('href','#');
    objBottomNav.appendChild(objClose);
  var objPause = this.doc.createElement("a");
    objPause.setAttribute('id','lb_lbPause');
    objPause.className = this.theme;
    objPause.setAttribute('href','#');
    objPause.style.display = 'none';
    objBottomNav.appendChild(objPause);
  var objPlay = this.doc.createElement("a");
    objPlay.setAttribute('id','lb_lbPlay');
    objPlay.className = this.theme;
    objPlay.setAttribute('href','#');
    objPlay.style.display = 'none';
    objBottomNav.appendChild(objPlay);
};
LyteBox.prototype.updateLyteboxItems = function() { 
  var anchors = (this.isFrame) ? window.parent.frames[window.name].document.getElementsByTagName('a') : document.getElementsByTagName('a');
  for (var i = 0; i < anchors.length; i++) {
    var anchor = anchors[i];
    var relAttribute = String(anchor.getAttribute('rel'));
    if (anchor.getAttribute('href')) {
      if (relAttribute.toLowerCase().match('lytebox')) {
        anchor.onclick = function () { myLytebox.start(this, false, false); return false; }
      } else if (relAttribute.toLowerCase().match('lyteshow')) {
        anchor.onclick = function () { myLytebox.start(this, true, false); return false; }
      } else if (relAttribute.toLowerCase().match('lyteframe')) {
        anchor.onclick = function () { myLytebox.start(this, false, true); return false; }
      }
    }
  }
};
LyteBox.prototype.start = function(imageLink, doSlide, doFrame) {
  if (this.ie && !this.ie7) { this.toggleSelects('hide'); }
  if (this.hideFlash) { this.toggleFlash('hide'); }
  this.isLyteframe = (doFrame ? true : false);
  var pageSize  = this.getPageSize();
  var objOverlay  = this.doc.getElementById('lb_lbOverlay');
  var objBody   = this.doc.getElementsByTagName("body").item(0);
  objOverlay.style.height = pageSize[1] + "px";
  objOverlay.style.display = '';
  this.appear('lb_lbOverlay', (this.doAnimations ? 0 : this.maxOpacity));
  var anchors = (this.isFrame) ? window.parent.frames[window.name].document.getElementsByTagName('a') : document.getElementsByTagName('a');
  if (this.isLyteframe) {
    this.frameArray = [];
    this.frameNum = 0;
    if ((imageLink.getAttribute('rel') == 'lyteframe')) {
      var rev = imageLink.getAttribute('rev');
      this.frameArray.push(new Array(imageLink.getAttribute('href'), imageLink.getAttribute('title'), (rev == null || rev == '' ? 'width: 400px; height: 400px; scrolling: auto;' : rev)));
    } else {
      if (imageLink.getAttribute('rel').indexOf('lyteframe') != -1) {
        for (var i = 0; i < anchors.length; i++) {
          var anchor = anchors[i];
          if (anchor.getAttribute('href') && (anchor.getAttribute('rel') == imageLink.getAttribute('rel'))) {
            var rev = anchor.getAttribute('rev');
            this.frameArray.push(new Array(anchor.getAttribute('href'), anchor.getAttribute('title'), (rev == null || rev == '' ? 'width: 400px; height: 400px; scrolling: auto;' : rev)));
          }
        }
        this.frameArray.removeDuplicates();
        while(this.frameArray[this.frameNum][0] != imageLink.getAttribute('href')) { this.frameNum++; }
      }
    }
  } else {
    this.imageArray = [];
    this.imageNum = 0;
    this.slideArray = [];
    this.slideNum = 0;
    if ((imageLink.getAttribute('rel') == 'lytebox')) {
      this.imageArray.push(new Array(imageLink.getAttribute('href'), imageLink.getAttribute('title')));
    } else {
      if (imageLink.getAttribute('rel').indexOf('lytebox') != -1) {
        for (var i = 0; i < anchors.length; i++) {
          var anchor = anchors[i];
          if (anchor.getAttribute('href') && (anchor.getAttribute('rel') == imageLink.getAttribute('rel'))) {
            this.imageArray.push(new Array(anchor.getAttribute('href'), anchor.getAttribute('title')));
          }
        }
        this.imageArray.removeDuplicates();
        while(this.imageArray[this.imageNum][0] != imageLink.getAttribute('href')) { this.imageNum++; }
      }
      if (imageLink.getAttribute('rel').indexOf('lyteshow') != -1) {
        for (var i = 0; i < anchors.length; i++) {
          var anchor = anchors[i];
          if (anchor.getAttribute('href') && (anchor.getAttribute('rel') == imageLink.getAttribute('rel'))) {
            this.slideArray.push(new Array(anchor.getAttribute('href'), anchor.getAttribute('title')));
          }
        }
        this.slideArray.removeDuplicates();
        while(this.slideArray[this.slideNum][0] != imageLink.getAttribute('href')) { this.slideNum++; }
      }
    }
  }
  var object = this.doc.getElementById('lb_lbMain');
    object.style.top = (this.getPageScroll() + (pageSize[3] / 15)) + "px";
    object.style.display = '';
  if (!this.outerBorder) {
    this.doc.getElementById('lb_lbOuterContainer').style.border = 'none';
    this.doc.getElementById('lb_lbDetailsContainer').style.border = 'none';
  } else {
    this.doc.getElementById('lb_lbOuterContainer').style.borderBottom = '';
    this.doc.getElementById('lb_lbOuterContainer').className = this.theme;
  }
  this.doc.getElementById('lb_lbOverlay').onclick = function() { myLytebox.end(); return false; }
  this.doc.getElementById('lb_lbMain').onclick = function(e) {
    var e = e;
    if (!e) {
      if (window.parent.frames[window.name] && (parent.document.getElementsByTagName('frameset').length <= 0)) {
        e = window.parent.window.event;
      } else {
        e = window.event;
      }
    }
    var id = (e.target ? e.target.id : e.srcElement.id);
    if (id == 'lb_lbMain') { myLytebox.end(); return false; }
  }
  this.doc.getElementById('lb_lbClose').onclick = function() { myLytebox.end(); return false; }
  this.doc.getElementById('lb_lbPause').onclick = function() { myLytebox.togglePlayPause("lb_lbPause", "lb_lbPlay"); return false; }
  this.doc.getElementById('lb_lbPlay').onclick = function() { myLytebox.togglePlayPause("lb_lbPlay", "lb_lbPause"); return false; } 
  this.isSlideshow = doSlide;
  this.isPaused = (this.slideNum != 0 ? true : false);
  if (this.isSlideshow && this.showPlayPause && this.isPaused) {
    this.doc.getElementById('lb_lbPlay').style.display = '';
    this.doc.getElementById('lb_lbPause').style.display = 'none';
  }
  if (this.isLyteframe) {
    this.changeContent(this.frameNum);
  } else {
    if (this.isSlideshow) {
      this.changeContent(this.slideNum);
    } else {
      this.changeContent(this.imageNum);
    }
  }
};
LyteBox.prototype.changeContent = function(imageNum) {
  if (this.isSlideshow) {
    for (var i = 0; i < this.slideshowIDCount; i++) { window.clearTimeout(this.slideshowIDArray[i]); }
  }
  this.activeImage = this.activeSlide = this.activeFrame = imageNum;
  if (!this.outerBorder) {
    this.doc.getElementById('lb_lbOuterContainer').style.border = 'none';
    this.doc.getElementById('lb_lbDetailsContainer').style.border = 'none';
  } else {
    this.doc.getElementById('lb_lbOuterContainer').style.borderBottom = '';
    this.doc.getElementById('lb_lbOuterContainer').className = this.theme;
  }
  this.doc.getElementById('lb_lbLoading').style.display = '';
  this.doc.getElementById('lb_lbImage').style.display = 'none';
  this.doc.getElementById('lb_lbIframe').style.display = 'none';
  this.doc.getElementById('lb_lbPrev').style.display = 'none';
  this.doc.getElementById('lb_lbNext').style.display = 'none';
  this.doc.getElementById('lb_lbIframeContainer').style.display = 'none';
  this.doc.getElementById('lb_lbDetailsContainer').style.display = 'none';
  this.doc.getElementById('lb_lbNumberDisplay').style.display = 'none';
  if (this.navType == 2 || this.isLyteframe) {
    object = this.doc.getElementById('lb_lbNavDisplay');
    object.innerHTML = '&nbsp;&nbsp;&nbsp;<span id="lb_lbPrev2_Off" style="display: none;" class="' + this.theme + '">&laquo; prev</span><a href="#" id="lb_lbPrev2" class="' + this.theme + '" style="display: none;">&laquo; prev</a> <b id="lb_lbSpacer" class="' + this.theme + '">||</b> <span id="lb_lbNext2_Off" style="display: none;" class="' + this.theme + '">next &raquo;</span><a href="#" id="lb_lbNext2" class="' + this.theme + '" style="display: none;">next &raquo;</a>';
    object.style.display = 'none';
  }
  if (this.isLyteframe) {
    var iframe = myLytebox.doc.getElementById('lb_lbIframe');
    var styles = this.frameArray[this.activeFrame][2];
    var aStyles = styles.split(';');
    for (var i = 0; i < aStyles.length; i++) {
      if (aStyles[i].indexOf('width:') >= 0) {
        var w = aStyles[i].replace('width:', '');
        iframe.width = w.trim();
      } else if (aStyles[i].indexOf('height:') >= 0) {
        var h = aStyles[i].replace('height:', '');
        iframe.height = h.trim();
      } else if (aStyles[i].indexOf('scrolling:') >= 0) {
        var s = aStyles[i].replace('scrolling:', '');
        iframe.scrolling = s.trim();
      } else if (aStyles[i].indexOf('border:') >= 0) {
        // Not implemented yet, as there are cross-platform issues with setting the border (from a GUI standpoint)
        //var b = aStyles[i].replace('border:', '');
        //iframe.style.border = b.trim();
      }
    }
    this.resizeContainer(parseInt(iframe.width), parseInt(iframe.height));
  } else {
    imgPreloader = new Image();
    imgPreloader.onload = function() {
      var imageWidth = imgPreloader.width;
      var imageHeight = imgPreloader.height;
      if (myLytebox.autoResize) {
        var pagesize = myLytebox.getPageSize();
        var x = pagesize[2] - 150;
        var y = pagesize[3] - 150;
        if (imageWidth > x) {
          imageHeight = Math.round(imageHeight * (x / imageWidth));
          imageWidth = x; 
          if (imageHeight > y) { 
            imageWidth = Math.round(imageWidth * (y / imageHeight));
            imageHeight = y; 
          }
        } else if (imageHeight > y) { 
          imageWidth = Math.round(imageWidth * (y / imageHeight));
          imageHeight = y; 
          if (imageWidth > x) {
            imageHeight = Math.round(imageHeight * (x / imageWidth));
            imageWidth = x;
          }
        }
      }
      var lbImage = myLytebox.doc.getElementById('lb_lbImage')
      lbImage.src = (myLytebox.isSlideshow ? myLytebox.slideArray[myLytebox.activeSlide][0] : myLytebox.imageArray[myLytebox.activeImage][0]);
      lbImage.width = imageWidth;
      lbImage.height = imageHeight;
      myLytebox.resizeContainer(imageWidth, imageHeight);
      imgPreloader.onload = function() {};
    }
    imgPreloader.src = (this.isSlideshow ? this.slideArray[this.activeSlide][0] : this.imageArray[this.activeImage][0]);
  }
};
LyteBox.prototype.resizeContainer = function(imgWidth, imgHeight) {
    
    var object = this.doc.getElementById('lb_lbOuterContainer');
  var borders = this.getBorders(object);
    this.wCur = object.offsetWidth - borders.left - borders.right;
  this.hCur = object.offsetHeight - borders.top - borders.bottom;
    
  this.xScale = ((imgWidth  + (this.borderSize * 2)) / this.wCur) * 100;
  this.yScale = ((imgHeight  + (this.borderSize * 2)) / this.hCur) * 100;
  var wDiff = (this.wCur - this.borderSize * 2) - imgWidth;
  var hDiff = (this.hCur - this.borderSize * 2) - imgHeight;
  if (!(hDiff == 0)) {
    this.hDone = false;
    this.resizeH('lb_lbOuterContainer', this.hCur, imgHeight + this.borderSize*2, this.getPixelRate(this.hCur, imgHeight));
  } else {
    this.hDone = true;
  }
  if (!(wDiff == 0)) {
    this.wDone = false;
    this.resizeW('lb_lbOuterContainer', this.wCur, imgWidth + this.borderSize*2, this.getPixelRate(this.wCur, imgWidth));
  } else {
    this.wDone = true;
  }
  if ((hDiff == 0) && (wDiff == 0)) {
    if (this.ie){ this.pause(250); } else { this.pause(100); } 
  }
  this.doc.getElementById('lb_lbPrev').style.height = imgHeight + "px";
  this.doc.getElementById('lb_lbNext').style.height = imgHeight + "px";
  this.doc.getElementById('lb_lbDetailsContainer').style.width = (imgWidth + (this.borderSize * 2) + (this.ie && this.doc.compatMode == "BackCompat" && this.outerBorder ? 2 : 0)) + "px";
  this.showContent();
};
LyteBox.prototype.showContent = function() {
  if (this.wDone && this.hDone) {
    for (var i = 0; i < this.showContentTimerCount; i++) { window.clearTimeout(this.showContentTimerArray[i]); }
    if (this.outerBorder) {
      this.doc.getElementById('lb_lbOuterContainer').style.borderBottom = 'none';
    }
    this.doc.getElementById('lb_lbLoading').style.display = 'none';
    if (this.isLyteframe) {
      this.doc.getElementById('lb_lbIframe').style.display = '';
      this.appear('lb_lbIframe', (this.doAnimations ? 0 : 100));
    } else {
      this.doc.getElementById('lb_lbImage').style.display = '';
      this.appear('lb_lbImage', (this.doAnimations ? 0 : 100));
      this.preloadNeighborImages();
    }
    if (this.isSlideshow) {
      if(this.activeSlide == (this.slideArray.length - 1)) {
        if (this.autoEnd) {
          this.slideshowIDArray[this.slideshowIDCount++] = setTimeout("myLytebox.end('slideshow')", this.slideInterval);
        }
      } else {
        if (!this.isPaused) {
          this.slideshowIDArray[this.slideshowIDCount++] = setTimeout("myLytebox.changeContent("+(this.activeSlide+1)+")", this.slideInterval);
        }
      }
      this.doc.getElementById('lb_lbHoverNav').style.display = (this.showNavigation && this.navType == 1 ? '' : 'none');
      this.doc.getElementById('lb_lbClose').style.display = (this.showClose ? '' : 'none');
      this.doc.getElementById('lb_lbDetails').style.display = (this.showDetails ? '' : 'none');
      this.doc.getElementById('lb_lbPause').style.display = (this.showPlayPause && !this.isPaused ? '' : 'none');
      this.doc.getElementById('lb_lbPlay').style.display = (this.showPlayPause && !this.isPaused ? 'none' : '');
      this.doc.getElementById('lb_lbNavDisplay').style.display = (this.showNavigation && this.navType == 2 ? '' : 'none');
    } else {
      this.doc.getElementById('lb_lbHoverNav').style.display = (this.navType == 1 && !this.isLyteframe ? '' : 'none');
      if ((this.navType == 2 && !this.isLyteframe && this.imageArray.length > 1) || (this.frameArray.length > 1 && this.isLyteframe)) {
        this.doc.getElementById('lb_lbNavDisplay').style.display = '';
      } else {
        this.doc.getElementById('lb_lbNavDisplay').style.display = 'none';
      }
      this.doc.getElementById('lb_lbClose').style.display = '';
      this.doc.getElementById('lb_lbDetails').style.display = '';
      this.doc.getElementById('lb_lbPause').style.display = 'none';
      this.doc.getElementById('lb_lbPlay').style.display = 'none';
    }
    this.doc.getElementById('lb_lbImageContainer').style.display = (this.isLyteframe ? 'none' : '');
    this.doc.getElementById('lb_lbIframeContainer').style.display = (this.isLyteframe ? '' : 'none');
    try {
      this.doc.getElementById('lb_lbIframe').src = this.frameArray[this.activeFrame][0];
    } catch(e) { }
  } else {
    this.showContentTimerArray[this.showContentTimerCount++] = setTimeout("myLytebox.showContent()", 200);
  }
};
LyteBox.prototype.updateDetails = function() {
  var object = this.doc.getElementById('lb_lbCaption');
  var sTitle = (this.isSlideshow ? this.slideArray[this.activeSlide][1] : (this.isLyteframe ? this.frameArray[this.activeFrame][1] : this.imageArray[this.activeImage][1]));
  object.style.display = '';
  object.innerHTML = (sTitle == null ? '' : sTitle);
  this.updateNav();
  this.doc.getElementById('lb_lbDetailsContainer').style.display = '';
  object = this.doc.getElementById('lb_lbNumberDisplay');
  if (this.isSlideshow && this.slideArray.length > 1) {
    object.style.display = '';
    object.innerHTML = "Image " + eval(this.activeSlide + 1) + " of " + this.slideArray.length;
    this.doc.getElementById('lb_lbNavDisplay').style.display = (this.navType == 2 && this.showNavigation ? '' : 'none');
  } else if (this.imageArray.length > 1 && !this.isLyteframe) {
    object.style.display = '';
    object.innerHTML = "Image " + eval(this.activeImage + 1) + " of " + this.imageArray.length;
    this.doc.getElementById('lb_lbNavDisplay').style.display = (this.navType == 2 ? '' : 'none');
  } else if (this.frameArray.length > 1 && this.isLyteframe) {
    object.style.display = '';
    object.innerHTML = "Page " + eval(this.activeFrame + 1) + " of " + this.frameArray.length;
    this.doc.getElementById('lb_lbNavDisplay').style.display = '';
  } else {
    this.doc.getElementById('lb_lbNavDisplay').style.display = 'none';
  }
  this.appear('lb_lbDetailsContainer', (this.doAnimations ? 0 : 100));
};

LyteBox.prototype.enableKeyboardNav = function() { document.onkeydown = this.keyboardAction; };
LyteBox.prototype.disableKeyboardNav = function() { document.onkeydown = ''; };
 
 
 
LyteBox.prototype.end = function(caller) {
  var closeClick = (caller == 'slideshow' ? false : true);
  if (this.isSlideshow && this.isPaused && !closeClick) { return; }
  this.disableKeyboardNav();
  this.doc.getElementById('lb_lbMain').style.display = 'none';
  this.fade('lb_lbOverlay', (this.doAnimations ? this.maxOpacity : 0));
  this.toggleSelects('visible');
  if (this.hideFlash) { this.toggleFlash('visible'); }
  if (this.isSlideshow) {
    for (var i = 0; i < this.slideshowIDCount; i++) { window.clearTimeout(this.slideshowIDArray[i]); }
  }
  if (this.isLyteframe) {
     this.initialize();
  }
};
LyteBox.prototype.checkFrame = function() {
  if (window.parent.frames[window.name] && (parent.document.getElementsByTagName('frameset').length <= 0)) {
    this.isFrame = true;
    this.lytebox = "window.parent." + window.name + ".myLytebox";
    this.doc = parent.document;
  } else {
    this.isFrame = false;
    this.lytebox = "myLytebox";
    this.doc = document;
  }
};
LyteBox.prototype.getPixelRate = function(cur, img) {
  var diff = (img > cur) ? img - cur : cur - img;
  if (diff >= 0 && diff <= 100) { return 10; }
  if (diff > 100 && diff <= 200) { return 15; }
  if (diff > 200 && diff <= 300) { return 20; }
  if (diff > 300 && diff <= 400) { return 25; }
  if (diff > 400 && diff <= 500) { return 30; }
  if (diff > 500 && diff <= 600) { return 35; }
  if (diff > 600 && diff <= 700) { return 40; }
  if (diff > 700) { return 45; }
};
LyteBox.prototype.appear = function(id, opacity) {
  var object = this.doc.getElementById(id).style;
  object.opacity = (opacity / 100);
  object.MozOpacity = (opacity / 100);
  object.KhtmlOpacity = (opacity / 100);
  object.filter = "alpha(opacity=" + (opacity + 10) + ")";
  if (opacity == 100 && (id == 'lb_lbImage' || id == 'lb_lbIframe')) {
    try { object.removeAttribute("filter"); } catch(e) {} /* Fix added for IE Alpha Opacity Filter bug. */
    this.updateDetails();
  } else if (opacity >= this.maxOpacity && id == 'lb_lbOverlay') {
    for (var i = 0; i < this.overlayTimerCount; i++) { window.clearTimeout(this.overlayTimerArray[i]); }
    return;
  } else if (opacity >= 100 && id == 'lb_lbDetailsContainer') {
    try { object.removeAttribute("filter"); } catch(e) {} /* Fix added for IE Alpha Opacity Filter bug. */
    for (var i = 0; i < this.imageTimerCount; i++) { window.clearTimeout(this.imageTimerArray[i]); }
    this.doc.getElementById('lb_lbOverlay').style.height = this.getPageSize()[1] + "px";
  } else {
    if (id == 'lb_lbOverlay') {
      this.overlayTimerArray[this.overlayTimerCount++] = setTimeout("myLytebox.appear('" + id + "', " + (opacity+20) + ")", 1);
    } else {
      this.imageTimerArray[this.imageTimerCount++] = setTimeout("myLytebox.appear('" + id + "', " + (opacity+10) + ")", 1);
    }
  }
};
LyteBox.prototype.fade = function(id, opacity) {
  var object = this.doc.getElementById(id).style;
  object.opacity = (opacity / 100);
  object.MozOpacity = (opacity / 100);
  object.KhtmlOpacity = (opacity / 100);
  object.filter = "alpha(opacity=" + opacity + ")";
  if (opacity <= 0) {
    try {
      object.display = 'none';
    } catch(err) { }
  } else if (id == 'lb_lbOverlay') {
    this.overlayTimerArray[this.overlayTimerCount++] = setTimeout("myLytebox.fade('" + id + "', " + (opacity-20) + ")", 1);
  } else {
    this.timerIDArray[this.timerIDCount++] = setTimeout("myLytebox.fade('" + id + "', " + (opacity-10) + ")", 1);
  }
};
LyteBox.prototype.resizeW = function(id, curW, maxW, pixelrate, speed) {
  if (!this.hDone) {
    this.resizeWTimerArray[this.resizeWTimerCount++] = setTimeout("myLytebox.resizeW('" + id + "', " + curW + ", " + maxW + ", " + pixelrate + ")", 100);
    return;
  }
  var object = this.doc.getElementById(id);
  var timer = speed ? speed : (this.resizeDuration/2);
  var newW = (this.doAnimations ? curW : maxW);
  object.style.width = (newW) + "px";
  if (newW < maxW) {
    newW += (newW + pixelrate >= maxW) ? (maxW - newW) : pixelrate;
  } else if (newW > maxW) {
    newW -= (newW - pixelrate <= maxW) ? (newW - maxW) : pixelrate;
  }
  this.resizeWTimerArray[this.resizeWTimerCount++] = setTimeout("myLytebox.resizeW('" + id + "', " + newW + ", " + maxW + ", " + pixelrate + ", " + (timer+0.02) + ")", timer+0.02);
  if (parseInt(object.style.width) == maxW) {
    this.wDone = true;
    for (var i = 0; i < this.resizeWTimerCount; i++) { window.clearTimeout(this.resizeWTimerArray[i]); }
  }
};
LyteBox.prototype.resizeH = function(id, curH, maxH, pixelrate, speed) {
  var timer = speed ? speed : (this.resizeDuration/2);
  var object = this.doc.getElementById(id);
  var newH = (this.doAnimations ? curH : maxH);
  object.style.height = (newH) + "px";
  if (newH < maxH) {
    newH += (newH + pixelrate >= maxH) ? (maxH - newH) : pixelrate;
  } else if (newH > maxH) {
    newH -= (newH - pixelrate <= maxH) ? (newH - maxH) : pixelrate;
  }
  this.resizeHTimerArray[this.resizeHTimerCount++] = setTimeout("myLytebox.resizeH('" + id + "', " + newH + ", " + maxH + ", " + pixelrate + ", " + (timer+.02) + ")", timer+.02);
  if (parseInt(object.style.height) == maxH) {
    this.hDone = true;
    for (var i = 0; i < this.resizeHTimerCount; i++) { window.clearTimeout(this.resizeHTimerArray[i]); }
  }
};
LyteBox.prototype.getPageScroll = function() {
  if (self.pageYOffset) {
    return this.isFrame ? parent.pageYOffset : self.pageYOffset;
  } else if (this.doc.documentElement && this.doc.documentElement.scrollTop){
    return this.doc.documentElement.scrollTop;
  } else if (document.body) {
    return this.doc.body.scrollTop;
  }
};
LyteBox.prototype.getPageSize = function() {  
  var xScroll, yScroll, windowWidth, windowHeight;
  if (window.innerHeight && window.scrollMaxY) {
    xScroll = this.doc.scrollWidth;
    yScroll = (this.isFrame ? parent.innerHeight : self.innerHeight) + (this.isFrame ? parent.scrollMaxY : self.scrollMaxY);
  } else if (this.doc.body.scrollHeight > this.doc.body.offsetHeight){
    xScroll = this.doc.body.scrollWidth;
    yScroll = this.doc.body.scrollHeight;
  } else {
    xScroll = this.doc.getElementsByTagName("html").item(0).offsetWidth;
    yScroll = this.doc.getElementsByTagName("html").item(0).offsetHeight;
    xScroll = (xScroll < this.doc.body.offsetWidth) ? this.doc.body.offsetWidth : xScroll;
    yScroll = (yScroll < this.doc.body.offsetHeight) ? this.doc.body.offsetHeight : yScroll;
  }
  if (self.innerHeight) {
    windowWidth = (this.isFrame) ? parent.innerWidth : self.innerWidth;
    windowHeight = (this.isFrame) ? parent.innerHeight : self.innerHeight;
  } else if (document.documentElement && document.documentElement.clientHeight) {
    windowWidth = this.doc.documentElement.clientWidth;
    windowHeight = this.doc.documentElement.clientHeight;
  } else if (document.body) {
    windowWidth = this.doc.getElementsByTagName("html").item(0).clientWidth;
    windowHeight = this.doc.getElementsByTagName("html").item(0).clientHeight;
    windowWidth = (windowWidth == 0) ? this.doc.body.clientWidth : windowWidth;
    windowHeight = (windowHeight == 0) ? this.doc.body.clientHeight : windowHeight;
  }
  var pageHeight = (yScroll < windowHeight) ? windowHeight : yScroll;
  var pageWidth = (xScroll < windowWidth) ? windowWidth : xScroll;
  return new Array(pageWidth, pageHeight, windowWidth, windowHeight);
};
LyteBox.prototype.toggleFlash = function(state) {
  var objects = this.doc.getElementsByTagName("object");
  for (var i = 0; i < objects.length; i++) {
    objects[i].style.visibility = (state == "hide") ? 'hidden' : 'visible';
  }
  var embeds = this.doc.getElementsByTagName("embed");
  for (var i = 0; i < embeds.length; i++) {
    embeds[i].style.visibility = (state == "hide") ? 'hidden' : 'visible';
  }
  if (this.isFrame) {
    for (var i = 0; i < parent.frames.length; i++) {
      try {
        objects = parent.frames[i].window.document.getElementsByTagName("object");
        for (var j = 0; j < objects.length; j++) {
          objects[j].style.visibility = (state == "hide") ? 'hidden' : 'visible';
        }
      } catch(e) { }
      try {
        embeds = parent.frames[i].window.document.getElementsByTagName("embed");
        for (var j = 0; j < embeds.length; j++) {
          embeds[j].style.visibility = (state == "hide") ? 'hidden' : 'visible';
        }
      } catch(e) { }
    }
  }
};
LyteBox.prototype.toggleSelects = function(state) {
  var selects = this.doc.getElementsByTagName("select");
  for (var i = 0; i < selects.length; i++ ) {
    selects[i].style.visibility = (state == "hide") ? 'hidden' : 'visible';
  }
  if (this.isFrame) {
    for (var i = 0; i < parent.frames.length; i++) {
      try {
        selects = parent.frames[i].window.document.getElementsByTagName("select");
        for (var j = 0; j < selects.length; j++) {
          selects[j].style.visibility = (state == "hide") ? 'hidden' : 'visible';
        }
      } catch(e) { }
    }
  }
};
LyteBox.prototype.pause = function(numberMillis) {
  var now = new Date();
  var exitTime = now.getTime() + numberMillis;
  while (true) {
    now = new Date();
    if (now.getTime() > exitTime) { return; }
  }
};
LyteBox.prototype.getBorderWidth = function(style, width) {
  if (style == 'none') {
    return 0;
  }
  else {
    var floatWidth = parseFloat(width);
    if (isNaN(floatWidth)) {
      return 0;
    }
    else {
      return Math.round(floatWidth);
    }
  }
};
LyteBox.prototype.readStyle = function(element, property) {
  if (element.style[property]) {
    return element.style[property];
  }
  else if (element.currentStyle) {
    return element.currentStyle[property];
  }
  else if (document.defaultView && document.defaultView.getComputedStyle) {
    var style = document.defaultView.getComputedStyle(element, null);
    return style.getPropertyValue(property);
  }
  else {
    return null;
  }
};
LyteBox.prototype.getBorders = function(element) {
  if (window.addEventListener) {
    var top = this.getBorderWidth(this.readStyle(element, 'border-top-style'), this.readStyle(element, 'border-top-width'));
    var right = this.getBorderWidth(this.readStyle(element, 'border-right-style'), this.readStyle(element, 'border-right-width'));
    var bottom = this.getBorderWidth(this.readStyle(element, 'border-bottom-style'), this.readStyle(element, 'border-bottom-width'));
    var left = this.getBorderWidth(this.readStyle(element, 'border-left-style'), this.readStyle(element, 'border-left-width'));
  }
  else {
    var top = this.getBorderWidth(this.readStyle(element, 'borderTopStyle'), this.readStyle(element, 'borderTopWidth'));
    var right = this.getBorderWidth(this.readStyle(element, 'borderRightStyle'), this.readStyle(element, 'borderRightWidth'));
    var bottom = this.getBorderWidth(this.readStyle(element, 'borderBottomStyle'), this.readStyle(element, 'borderBottomWidth'));
    var left = this.getBorderWidth(this.readStyle(element, 'borderLeftStyle'), this.readStyle(element, 'borderLeftWidth'));
  };
  return {top: top, right: right, bottom: bottom, left: left}
};
if (window.addEventListener) {
  window.addEventListener("load",initLytebox,false);
} else if (window.attachEvent) {
  window.attachEvent("onload",initLytebox);
} else {
  window.onload = function() {initLytebox();}
}
function initLytebox() { myLytebox = new LyteBox(); }

 