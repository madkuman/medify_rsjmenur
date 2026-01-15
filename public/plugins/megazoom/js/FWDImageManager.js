/* Image manager */
(function (){
	
	var FWDImageManager = function(data, parent){
		
		var self = this;
		var prototype = FWDImageManager.prototype;
		
		this.originalImage_img;
		this.toolTipLeft_img = data.toolTipLeft_img;
		this.toolTipPointer_img = data.toolTipPointer_img;
		
		this.markers_ar = [];
		this.toolTipWindows_ar = [];
		this.toolTipDataWindows_ar = data.toolTipWindows_ar;
		this.markersList_ar = data.markersList_ar;
		this.markersPosition_ar = data.markersPosition_ar;
		this.largeImagesPaths_ar = data.largeImagesPaths_ar;
		
		this.curMarker_do;
		this.markersToolTip_do;
		this.markersToolTipWindow_do;
		this.hider;
		this.dumy_sdo;
		this.slicesHolder_do;
		this.smallImage_sdo;
		this.markersPositionInfo_sdo;
		this.disableMouseWheel_bl = data.disableMouseWheel_bl;
		
		this.handMovePath_str =  data.handMovePath_str;
		this.handGrabPath_str =  data.handGrabPath_str;
		this.backgroundColor_str = parent.backgroundColor_str;
		this.draggingMode_str = data.startDraggingMode_str;
		this.controllerPosition_str = data.controllerPosition_str;
		this.buttonToolTipLeft_str = data.buttonToolTipLeft_str;
		this.buttonToolTipMiddle_str = data.buttonToolTipMiddle_str;
		this.buttonToolTipRight_str = data.buttonToolTipRight_str;
		this.buttonToolTipFontColor_str = data.buttonToolTipFontColor_str;
		this.buttonToolTipBottomPointer_str = data.buttonToolTipBottomPointer_str;
		this.buttonToolTipTopPointer_str = data.buttonToolTipTopPointer_str;
		this.lastMarkerId_str;
		
		this.curId = 0;
		this.prevId = 1000;
		this.curLargeImageId = 1000;
		this.totalImages = data.totalImages;
		this.totalToolTipsWindows = self.toolTipDataWindows_ar.length;
		this.stageWidth;
		this.stageHeight;
		this.smallestPossibleScale;
		this.currentScale = undefined;
		this.sliceCurrentScale = 1;
		this.prevScale = 0;
		this.percentZoomed = 0.1;
		this.imageWidth;
		this.imageHeight;
		this.doubleClickZoomFactor = data.doubleClickZoomFactor;
		this.zoomFactor = data.zoomFactor;
		this.startZoomFactor = data.startZoomFactor;
		this.zoomSpeed = data.zoomSpeed;
		this.finalX = 0;
		this.finalY = 0;
		this.xPositionOnPress;
		this.yPositionOnPress;
		this.lastPresedX = 0;
		this.lastPresedY = 0;
		this.lastPresedX2 = 0;
		this.lastPresedY2 = 0;
		this.mouseX = 0;
		this.mouseY = 0;
		this.controllerHeight = data.controllerHeight;
		this.controllerOffsetY = data.controllerOffsetY;
		this.rotationSpeed = Math.abs(-1.1 + data.dragRotationSpeed);
		this.startScaleForMobileZoom;
		this.totalMarkers;
		this.globalX;
		this.globalY;
		this.markerToolTipOffsetY = data.markerToolTipOffsetY;
		this.toolTipWindowMaxWidth = data.toolTipWindowMaxWidth;
		this.sliceWidth = data.sliceWidth;
		this.sliceHeight = data.sliceHeight;
		this.cols = data.cols;
		this.rows = data.rows;
		this.panSpeed = data.panSpeed;
		this.panDirectionSign = data.inversePanDirection_bl ? -1 : 1;
		
		this.tweenDone_to;
		this.removeSmallSDOId_to;
		this.setAlphaWithDelayId_to;
		this.hideToolTipWindowId_to;
		this.addHideToolTipWindowTestWithDelayId_to;
		this.showToolTipWindoId_to;
		this.showMarkerToolTipId_to;
		this.setupMarkersAndToolTipWindowsId_to;
		this.secondTapId_to;
		this.enableMarkersId_to;
		this.showMarkersFirstTimeId_to;
		
		this.showMarkersFirstTimeDone_bl = false;
		this.allowToDragHoriz_bl = false;
		this.allowToDragVert_bl = false;
		this.isTweening_bl = false;
		this.isDragging_bl = false;
		this.isScrollBarHandlerPressed_bl = false;
		this.isResizingFirstTime_bl = true;
		this.isControllerActive_bl = false;
		this.useEntireScreenFor3dObject_bl = data.useEntireScreenFor3dObject_bl;
		this.isMobile_bl = data.isMobile_bl;
		this.showNavigator_bl = data.showNavigator_bl;
		this.showMarkers_bl = data.showMarkers_bl;
		this.isNavigatorShowed_bl = false;
		this.addImageFirstTimeOnActivate_bl = true;
		this.showMarkersInfo_bl = data.showMarkersInfo_bl;
		this.updateScrollBarWithDelay_bl = true;
		this.areLeftAndRightButtonsDisabled_bl = false;
		this.areUpAndDownButtonsDisabled_bl = false;
		this.isMobile_bl = data.isMobile_bl;
		this.addDoubleClickSupport_bl = data.addDoubleClickSupport_bl;
		this.showLargeImageVersionOnZoom_bl = data.showLargeImageVersionOnZoom_bl;
		this.hasPointerEvent_bl = FWDUtils.hasPointerEvent;
		
		self.init = function(){
			if(self.controllerPosition_str == FWDController.POSITION_TOP && !self.useEntireScreenFor3dObject_bl) self.setY(self.controllerHeight);
			self.setupMainContiners();
			
			if(!self.showMarkersInfo_bl) self.dumy_sdo.screen.style.cursor = 'url(' + self.handMovePath_str + '), default';
			self.originalImage_img = data.originalImage_img;
			self.imageWidth = data.imageWidth;
			self.imageHeight = data.imageHeight;
	
			self.addImage();
			
			if(self.isMobile_bl){
				self.addPannSupportForMobile();
			}else{
				self.addPannSupport();
			}
		
			if(!self.disableMouseWheel_bl) self.addMouseWheelSupport();
			if(self.addDoubleClickSupport_bl) self.addDoubleClickSupport();
			
			self.setupMarkersAndToolTipWindowsId_to = setTimeout(self.setupMarkersAndToolTipWindows, 2000);
			
			if(self.showMarkersInfo_bl) self.setupMarkersInfo();
			self.resizeAndPosition(true);
			self.showMarkersFirstTime();
		};
		
		//###########################################//
		/* Setup markers */
		//###########################################//
		this.setupMarkersAndToolTipWindows = function(){
			
			if(self.showMarkers_bl){
				self.setupMarkers();
				if(!self.isMobile_bl || self.hasPointerEvent_bl) self.setupMarkersToolTip();
				self.setupMarkersToolTipWindows();
				self.positionMarkers(false);
			}
			
			if(self.showNavigator_bl){
				self.hideOrShowNavigator();
				self.updateNavigator(false);
			}
			
			if(self.stageHeight < self.finalHeight){
				self.dispatchEvent(FWDImageManager.ENABLE_UP_AND_DOWN_BUTTONS);
				self.areUpAndDownButtonsDisabled_bl = true;
			}
		
			if(self.stageWidth < self.finalWidth){
				self.dispatchEvent(FWDImageManager.ENABLE_LEFT_AND_RIGHT_BUTTONS);
				self.areLeftAndRightButtonsDisabled_bl = true;
			}
		};
		
		//##########################################//
		//Setup hider.
		//##########################################//
		self.setupHider = function(hider){
			self.hider = hider;
		};
		
		//################################################//
		//add small and large image.
		//################################################//
		self.addImage = function(){
			
			self.smallImage_sdo = new FWDTransformDisplayObject("img");
			self.smallImage_sdo.setScreen(self.originalImage_img);
			self.smallImage_sdo.setTransformOrigin(0,0);
		
			self.addImageFirstTimeOnActivate_bl = false;
			
			self.addChild(self.smallImage_sdo);
			self.addChild(self.dumy_sdo);
		};
		
		//###########################################//
		//Setup main containers
		//###########################################//
		self.setupMainContiners = function(){
		
			self.setBkColor(self.backgroundColor_str);
			
			self.dumy_sdo = new FWDSimpleDisplayObject("div");
			if(FWDUtils.isIE){
				self.dumy_sdo.setBkColor("#00FF00");
				self.dumy_sdo.setAlpha(.01);
			}
			
			if(self.controllerPosition_str == FWDController.POSITION_TOP && !self.useEntireScreenFor3dObject_bl) self.dumy_sdo.setY(- self.controllerHeight);
		};
		
		//###########################################//
		// Resize and position self...
		//###########################################//
		self.resizeAndPosition = function(centerImage_bl, overwrite){
			if(self.stageWidth == parent.stageWidth && self.stageHeight == parent.stageHeight - self.controllerHeight && !overwrite) return;
			
			self.stageWidth = parent.stageWidth;
			
			if(self.useEntireScreenFor3dObject_bl){
				self.stageHeight = parent.stageHeight;
			}else{
				self.stageHeight = parent.stageHeight - self.controllerHeight;
			}
			
			self.setWidth(self.stageWidth);
			self.setHeight(self.stageHeight);
			var scX = self.stageWidth/self.imageWidth;
			var scY = self.stageHeight/self.imageHeight;
			var totalScale;
			
			if(scX < scY){
				totalScale = scX;
			}else{
				totalScale = scY;
			}
			
			if(totalScale >= self.zoomFactor) totalScale = self.zoomFactor;
			
			if(totalScale >= self.zoomFactor){
				self.currentScale = self.prevScale = self.smallestPossibleScale = self.zoomFactor;
			}else{
				self.smallestPossibleScale = totalScale;
				if(self.currentScale === undefined) self.currentScale =  self.prevScale = totalScale;
			}
			
			if(self.isResizingFirstTime_bl){
				if(!isNaN(self.startZoomFactor)){
					if(self.startZoomFactor > self.currentScale){
						self.currentScale = self.prevScale = self.startZoomFactor;
					}
				}
				self.isResizingFirstTime_bl = false;
			}
			
			self.finalWidth = Math.round(self.currentScale * self.imageWidth);
			self.finalHeight = Math.round(self.currentScale * self.imageHeight);
			
			if(scX <= scY && totalScale != self.zoomFactor){
				if(self.finalWidth < self.stageWidth){
					self.currentScale = self.stageWidth/self.imageWidth;
					self.smallestPossibleScale = self.currentScale;
				}
			}else if(scX >= scY && totalScale != self.zoomFactor){
				if(self.finalHeight < self.stageHeight){
					self.currentScale = self.stageHeight/self.imageHeight;
					self.smallestPossibleScale = self.currentScale;
				}
			}
			
			self.finalWidth = Math.round(self.currentScale * self.imageWidth);
			self.finalHeight = Math.round(self.currentScale * self.imageHeight);	
			
			self.dumy_sdo.setWidth(self.stageWidth);
			if(self.useEntireScreenFor3dObject_bl){
				self.dumy_sdo.setHeight(self.stageHeight);
			}else{
				self.dumy_sdo.setHeight(self.stageHeight + self.controllerHeight);
			}
			
			self.checkXAndYBouds();
			if(centerImage_bl) self.centerImage();
			self.resizeAndPositionImage();
			
			if(self.showNavigator_bl){
				self.hideOrShowNavigator();
				self.updateNavigator(false);
			}
			
			self.positionMarkers(false);
			
			setTimeout(function(){
				if(self == null) return;
					self.dispatchScrollBarUpdate(false);
				}
			, 50);
			
			self.disableOrEnableMoveButtons();
			self.dispatchScrollBarUpdate(false);
		};
		
		//###############################################//
		//resize and position small image and large image.
		//###############################################//
		self.resizeAndPositionImage = function(animate){
			self.isTweening_bl = true;
			FWDAnimation.killTweensOf(self.smallImage_sdo);
			
			clearTimeout(self.tweenDone_to);
			if(animate){	
				if(self.smallImage_sdo.hasTransform2d_bl){
					FWDAnimation.to(self.smallImage_sdo, .3, {x:self.finalX, y:self.finalY, scale:self.currentScale});
				}else{
					FWDAnimation.to(self.smallImage_sdo, .3, {w:self.finalWidth, h:self.finalHeight, x:self.finalX, y:self.finalY});
				}
				self.tweenDone_to = setTimeout(self.tweenDoneHandler, 300);
			}else{
				if(self.smallImage_sdo.hasTransform2d_bl){
					if(self.smallImage_sdo.hasTransform3d_bl){
						self.smallImage_sdo.setPositionAndScale(self.finalX, self.finalY, self.currentScale);	
					}else{
						self.smallImage_sdo.setScale2(self.currentScale);
						self.smallImage_sdo.setX(self.finalX);
						self.smallImage_sdo.setY(self.finalY);
					}
				}else{
					self.smallImage_sdo.setX(self.finalX);
					self.smallImage_sdo.setY(self.finalY);
					self.smallImage_sdo.setWidth(self.finalWidth);
					self.smallImage_sdo.setHeight(self.finalHeight);
				}
				
				self.isTweening_bl = false;
				self.dispatchEvent(FWDImageManager.IMAGE_ZOOM_COMPLETE);
			}

		};
		
		self.tweenDoneHandler = function(){
			self.isTweening_bl = false;
			self.dispatchEvent(FWDImageManager.IMAGE_ZOOM_COMPLETE);
		};
		
		//###############################################//
		/* check x and y position */
		//##############################################//
		self.checkXAndYBouds = function(){
		
			if(self.finalWidth <= self.stageWidth){
				self.finalX = Math.round((self.stageWidth - self.finalWidth)/2);
			}else if(self.finalWidth > self.stageWidth + 1){
				self.allowToDragHoriz_bl = true;	
				if(self.finalX > 0){
					self.finalX = 0;
				}else if(self.finalX <= self.stageWidth - self.finalWidth + 1){
					self.finalX = self.stageWidth - self.finalWidth + 1;
				}
			}else{
				self.allowToDragHoriz_bl = false;
			}
			
			if(self.finalHeight <= self.stageHeight ){
				self.finalY = Math.round((self.stageHeight - self.finalHeight)/2);
			}else if(self.finalHeight > self.stageHeight + 1){
				self.allowToDragVert_bl = true;
				if(self.finalY > 0){
					self.finalY = 0;
				}else if(self.finalY <= self.stageHeight - self.finalHeight){
					self.finalY = self.stageHeight - self.finalHeight;
				}
			}else{
				self.allowToDragVert_bl = false;
			}
		};
		
		//################################################//
		/* zoom image */
		//################################################//
		self.zoomImage = function(setPositionAndSize, animate){
			
			if(setPositionAndSize){
				self.finalWidth = Math.round(self.currentScale * self.imageWidth);
				self.finalHeight =  Math.round(self.currentScale * self.imageHeight);
				self.finalX -= Math.round((self.mouseX - self.finalX) * (self.currentScale - self.prevScale) / self.prevScale); 
				self.finalY -= Math.round((self.mouseY - self.finalY) * (self.currentScale - self.prevScale) / self.prevScale); 	
			}
			
			
			if(!self.isControllerActive_bl) self.dispatchScrollBarUpdate(animate);
			self.checkXAndYBouds();
			
			if(self.showNavigator_bl){
				self.hideOrShowNavigator();
				self.updateNavigator(animate);
			}
			self.positionMarkers(animate);
			self.disableOrEnableMoveButtons();
			self.resizeAndPositionImage(animate);
			
			self.prevScale = self.currentScale;
		};
		
		//###############################################//
		//Add touch pann support
		//###############################################//
		self.addPannSupport = function(){
			if(self.screen.addEventListener){
				self.dumy_sdo.screen.addEventListener("mousedown", self.panStartHandler, true);
			}else if(self.screen.attachEvent){
				self.dumy_sdo.screen.attachEvent("onmousedown", self.panStartHandler);
			}
		};
		
		self.panStartHandler = function(e){
			
			if(self.isTweening_bl || self.isControllerActive_bl || self.isTweening_bl) return;
			if(e.preventDefault) e.preventDefault();
			if(self.finalWidth < self.stageWidth && self.finalHeight < self.stageHeight) return;
			if(!self.isMobile_bl || e.pointerType == e.MSPOINTER_TYPE_MOUSE){
				if(e.button <= 1) parent.disableAll();
			}
			var viewportMouseCoordinates = FWDUtils.getViewportMouseCoordinates(e);		
			
			self.isDragging_bl = true;
			self.xPositionOnPress = self.smallImage_sdo.getX();
			self.yPositionOnPress = self.smallImage_sdo.getY();
			self.lastPresedX = viewportMouseCoordinates.screenX;
			self.lastPresedY = viewportMouseCoordinates.screenY;
			self.hideToolTipWindow();
			
			self.dispatchEvent(FWDImageManager.PAN_START);
			
			if(window.addEventListener){
				window.addEventListener("mousemove", self.panMoveHandler);
				window.addEventListener("mouseup", self.panEndHandler);	
			}else if(document.attachEvent){
				document.attachEvent("onmousemove", self.panMoveHandler);
				document.attachEvent("onmouseup", self.panEndHandler);
			}
		};
		
		self.panMoveHandler = function(e){
			if(e.preventDefault) e.preventDefault();
			if(e.touches && e.touches.length != 1 || self.isControllerActive_bl || self.isTweening_bl) return;
			var viewportMouseCoordinates = FWDUtils.getViewportMouseCoordinates(e);	
			
			if(self.finalWidth > self.stageWidth + 1){
				self.finalX = Math.round(self.xPositionOnPress + viewportMouseCoordinates.screenX - self.lastPresedX);
				if(self.finalX > 0){
					self.finalX = 0;
				}else if(self.finalX <= self.stageWidth - self.finalWidth + 1){
					self.finalX = self.stageWidth - self.finalWidth + 1;
				}
				
				self.smallImage_sdo.setX(self.finalX);
			}
			
			if(self.finalHeight > self.stageHeight + 1){
				self.finalY = Math.round(self.yPositionOnPress + viewportMouseCoordinates.screenY - self.lastPresedY);
				if(self.finalY > 0){
					self.finalY = 0;
				}else if(self.finalY <= self.stageHeight - self.finalHeight){
					self.finalY = self.stageHeight - self.finalHeight;
				}
				self.smallImage_sdo.setY(self.finalY);
			}
			
			if(self.showNavigator_bl){
				self.hideOrShowNavigator();
				self.updateNavigator(false);
			}
			
			self.positionMarkers(false);
		};
		
		self.panEndHandler = function(e){
			if(e.preventDefault) e.preventDefault();
			self.isDragging_bl = false;
			if(!self.isMobile_bl || e.pointerType == e.MSPOINTER_TYPE_MOUSE) parent.enableAll();
		
			if(window.removeEventListener){
				window.removeEventListener("mousemove", self.panMoveHandler);
				window.removeEventListener("mouseup", self.panEndHandler);	
			}else if(document.detachEvent){
				document.detachEvent("onmousemove", self.panMoveHandler);
				document.detachEvent("onmouseup", self.panEndHandler);
			}
		};

		//###############################################//
		//Add touch pann support
		//###############################################//
		this.addPannSupportForMobile = function(){
			if(self.hasPointerEvent_bl){
				this.screen.addEventListener("MSPointerDown", this.onTouchStart);
			}else{
				this.screen.addEventListener("touchstart", this.onTouchStart);
			}
		};	
		
		this.removeZoomDragAndSwipeForMobile = function(){
			if(self.hasPointerEvent_bl){
				this.screen.removeEventListener("MSPointerDown", this.onTouchStart);
				window.removeEventListener("MSPointerUp", self.windowOnTouchEnd);
				window.removeEventListener("MSPointerMove", self.windowOnTouchMove);
			}else{
				this.screen.removeEventListener("touchstart", this.onTouchStart);
				window.removeEventListener("touchend", self.windowOnTouchEnd);
				window.removeEventListener("touchmove", self.windowOnTouchMove);
			}
		};	
		
		this.onTouchStart = function(e){
			if(self.isZooming_bl) return;
			if(e.preventDefault) e.preventDefault();
		
			self.vx = 0;
			self.vy = 0; 
			
			if(e.touches){																	
				self.lastMouseX = self.firstTouchMouseX = e.touches[0].pageX - parent.globalX - parent.scrollOffsets.x;
				self.lastMouseY = self.firstTouchMouseY = e.touches[0].pageY - parent.globalY - parent.scrollOffsets.y;
			}else{
				self.lastMouseX = self.firstTouchMouseX = e.pageX - parent.globalX - parent.scrollOffsets.x;
				self.lastMouseY = self.firstTouchMouseY = e.pageY - parent.globalY - parent.scrollOffsets.y;
			}
			
			if(e.touches && e.touches.length == 2){
				self.disableOnDragOrSwipe_bl = true;
				self.lastMouseX2 = e.touches[1].pageX - parent.globalX - parent.scrollOffsets.x;
				self.lastMouseY2 = e.touches[1].pageY - parent.globalY - parent.scrollOffsets.y;
			}else if(e.touches && e.touches.length > 2){
				return;
			}
		
			if(self.hasPointerEvent_bl){
				window.addEventListener("MSPointerUp", self.windowOnTouchEnd);
				window.addEventListener("MSPointerMove", self.windowOnTouchMove);
			}else{
				window.addEventListener("touchend", self.windowOnTouchEnd);
				window.addEventListener("touchmove", self.windowOnTouchMove);
			}
		};
		
		self.finishPinching_bl = true;
		this.windowOnTouchMove = function(e){
			//if(self.isZooming_bl) return;
			if(e.preventDefault) e.preventDefault();
			
			var lcX;
			var lcY;
			var toAddX;
			var toAddY2;
			var posX1;
			var posY1;
			var posX2;
			var posY2;
			var pinchDist;
			var dx;
			var dy;
			var finalPosX;
			var finalPosY;
			
			if(e.touches){
				lcX = e.touches[0].pageX - parent.globalX - parent.scrollOffsets.x;
				lcY = e.touches[0].pageY - parent.globalY - parent.scrollOffsets.y;
			}else{
				lcX = e.pageX - parent.globalX - parent.scrollOffsets.x;
				lcY = e.pageY - parent.globalY - parent.scrollOffsets.y;
			}
			
			if(self.firstTouchMouseX < lcX - 1 || self.firstTouchMouseX > lcX + 1
			  || self.firstTouchMouseY < lcY - 1 || self.firstTouchMouseY > lcY + 1){
				self.disableOnDragOrSwipe_bl = true;
			}
			
			if(self.hasPointerEvent_bl){
				toAddX = e.pageX - parent.globalX - self.lastMouseX - parent.scrollOffsets.x;
				toAddY = e.pageY - parent.globalY - self.lastMouseY - parent.scrollOffsets.y;
				self.lastMouseX = lcX;
				self.lastMouseY = lcY;
				
				self.finalX += toAddX;
				self.finalY += toAddY;
				self.isDragged_bl = true;
			}else if(e.touches && e.touches.length == 1 && self.finishPinching_bl){
				toAddX = e.touches[0].pageX - parent.globalX - self.lastMouseX - parent.scrollOffsets.x;
				toAddY = e.touches[0].pageY - parent.globalY - self.lastMouseY - parent.scrollOffsets.y;
				self.lastMouseX = lcX;
				self.lastMouseY = lcY;
				
				if(self.finalWidth > self.stageWidth + 1){
					self.finalX += toAddX;
					if(self.finalX > 0){
						self.finalX = 0;
					}else if(self.finalX <= self.stageWidth - self.finalWidth + 1){
						self.finalX = self.stageWidth - self.finalWidth + 1;
					}
					
					self.smallImage_sdo.setX(self.finalX);
				}
				
				if(self.finalHeight > self.stageHeight + 1){
					self.finalY += toAddY;
					if(self.finalY > 0){
						self.finalY = 0;
					}else if(self.finalY <= self.stageHeight - self.finalHeight){
						self.finalY = self.stageHeight - self.finalHeight;
					}
					self.smallImage_sdo.setY(self.finalY);
				}
				
				if(self.finalWidth > self.stageWidth + 1 || self.finalHeight > self.stageHeight + 1){
					if(self.showNavigator_bl){
						self.hideOrShowNavigator();
						self.updateNavigator(false);
					}
					
					self.positionMarkers(false);
				}
				
				self.isDragged_bl = true;
			}else if(e.touches && e.touches.length == 2){
				self.finishPinching_bl = false;
				posX1 = lcX;
				posY1 = lcY;
				posX2 = e.touches[1].pageX - parent.globalX - parent.scrollOffsets.x;
				posY2 = e.touches[1].pageY - parent.globalY - parent.scrollOffsets.y;
				self.mouseX = finalPosX = (posX2 + posX1)/2;
				self.mouseY = finalPosY = (posY2 + posY1)/2;
				
				dx = posX1 - posX2;
				dy = posY1 - posY2;
				pinchDist = Math.sqrt(dx * dx + dy * dy);
				
				if(parseInt(self.pinchDist) != parseInt(pinchDist)){
					if(self.pinchDist > pinchDist){
						self.currentScale -= 0.02;
					}else{
						self.currentScale += 0.01;
					}
					
					if(parseFloat(self.currentScale.toFixed(5)) <= parseFloat(self.smallestPossibleScale.toFixed(5))){
						self.currentScale = self.smallestPossibleScale;
					}else if(self.currentScale > self.zoomFactor){
						 self.currentScale = self.zoomFactor;
					}

				}
				
				self.zoomImage(true, true);
				
				self.pinchDist = pinchDist;
			}
		
		};
		
		this.windowOnTouchEnd = function(e){
			if(e.preventDefault) e.preventDefault();
			if(self.hasPointerEvent_bl){
				window.removeEventListener("MSPointerUp", self.windowOnTouchEnd);
				window.removeEventListener("MSPointerMove", self.windowOnTouchMove);
				clearTimeout(self.disableOnDragOrSwipeId_to);
				self.disableOnDragOrSwipeId_to = setTimeout(function(){
					 self.disableOnDragOrSwipe_bl = false;
					 self.finishPinching_bl = true;
				}, 200);
			}else{
				if(e.touches.length == 0){
					clearTimeout(self.disableOnDragOrSwipeId_to);
					self.disableOnDragOrSwipeId_to = setTimeout(function(){
						 self.disableOnDragOrSwipe_bl = false;
						 self.finishPinching_bl = true;
					}, 200);
					window.removeEventListener("touchend", self.windowOnTouchEnd);
					window.removeEventListener("touchmove", self.windowOnTouchMove);
				}
			}
			
			
			self.isDragged_bl = false;
		};
		
		//###############################################//
		//Add mousewheel support.
		//###############################################//
		self.addMouseWheelSupport = function(){
			if(window.addEventListener){
				self.dumy_sdo.screen.addEventListener ("mousewheel", self.mouseWheelHandler);
				self.dumy_sdo.screen.addEventListener('DOMMouseScroll', self.mouseWheelHandler);
			}else if(document.attachEvent){
				
				self.dumy_sdo.screen.attachEvent("onmousewheel", self.mouseWheelHandler);
			}
		};
		
		self.mouseWheelHandler = function(e){
			if(e.preventDefault) e.preventDefault();
			if(self.isDragging_bl || self.isControllerActive_bl) return;
			var viewportMouseCoordinates = FWDUtils.getViewportMouseCoordinates(e);
			if(self.hider) self.hider.reset();
			self.mouseX = viewportMouseCoordinates.screenX - self.getGlobalX();
			self.mouseY = viewportMouseCoordinates.screenY - self.getGlobalY();
			
		
			var dir = e.detail || e.wheelDelta;	
			if(e.wheelDelta) dir *= -1;
			if(dir > 0){
				if(self.currentScale == self.smallestPossibleScale) return;
				self.currentScale -= self.zoomSpeed;
				if(parseFloat(self.currentScale.toFixed(5)) <= parseFloat(self.smallestPossibleScale.toFixed(5))) self.currentScale = self.smallestPossibleScale;
			}else if(dir < 0){
				if(self.currentScale == self.zoomFactor) return;
				self.currentScale += self.zoomSpeed;
				if(self.currentScale > self.zoomFactor) self.currentScale = self.zoomFactor;
			}
			
			self.zoomImage(true, true);
			
			if(e.preventDefault){
				e.preventDefault();
			}else{
				return false;
			}
		};
		
		//########################################//
		/* add double click and tap support */
		//########################################//
		this.addDoubleClickSupport = function(){	
			
			if(self.isMobile_bl){
				self.dumy_sdo.screen.addEventListener("touchstart", self.onFirstDown);
			}else{
				self.dumy_sdo.screen.addEventListener("mousedown", self.onFirstDown);
			}
		};
		
		this.onFirstDown = function(e){
			var viewportMouseCoordinates = FWDUtils.getViewportMouseCoordinates(e);
			self.firstTapX = viewportMouseCoordinates.screenX;
			self.firstTapY = viewportMouseCoordinates.screenY;
			
			if(self.isMobile_bl){
				clearTimeout(self.secondTapId_to);
				self.secondTapId_to = setTimeout(self.doubleTapExpired, 200);
				self.dumy_sdo.screen.addEventListener("touchstart", self.onSecondDown);
				self.dumy_sdo.screen.removeEventListener("touchstart", self.onFirstDown);
			}else{
				clearTimeout(self.secondTapId_to);
				self.secondTapId_to = setTimeout(self.doubleTapExpired, 200);
				self.dumy_sdo.screen.addEventListener("mousedown", self.onSecondDown);
				self.dumy_sdo.screen.removeEventListener("mousedown", self.onFirstDown);
			}
		};
		
		this.doubleTapExpired = function(){
			clearTimeout(self.secondTapId_to);
			if(self.isMobile_bl){
				self.dumy_sdo.screen.removeEventListener("touchstart", self.onSecondDown);
				self.dumy_sdo.screen.addEventListener("touchstart", self.onFirstDown);
			}else{
				self.dumy_sdo.screen.removeEventListener("mousedown", self.onSecondDown);
				self.dumy_sdo.screen.addEventListener("mousedown", self.onFirstDown);
			}
		};
		
		this.onSecondDown = function(e){
			var viewportMouseCoordinates = FWDUtils.getViewportMouseCoordinates(e);
			var dx;
			var dy;
			
			if(e.touches && e.touches.length != 1) return;
			if(self.currentScale == self.zoomFactor 
			   || self.doubleClickZoomFactor  < self.currentScale) return;
			dx = Math.abs(viewportMouseCoordinates.screenX - self.firstTapX);   
			dy = Math.abs(viewportMouseCoordinates.screenY - self.firstTapY); 
		
			if(self.isMobile_bl && (dx > 10 || dy > 10)){
				return;
			}else if(!self.isMobile_bl && (dx > 2 || dy > 2)){
				return
			}
		
			if(self.isMobile_bl) self.smallImage_sdo.screen.removeEventListener("touchstart", self.onSecondDown);
				
			self.mouseX = viewportMouseCoordinates.screenX - self.getGlobalX();
			self.mouseY  = viewportMouseCoordinates.screenY - self.getGlobalY();
		
			self.currentScale = self.zoomFactor;
			self.zoomImage(true, true);
			self.mouseX = self.stageWidth/2;
			self.mouseY = self.stageHeight/2;
		};
		
		//###########################################//
		/* Setup markers */
		//###########################################//
		self.setupMarkers = function(){
			var marker;
			var objData;
			var id = 0;
		
			self.totalMarkers = self.markersList_ar.length;
			
			for(var i=0; i<self.totalMarkers; i++){
				objData = self.markersList_ar[i];
				
				FWDMarker.setPrototype();
				marker = new FWDMarker(objData.markerId, 
						objData.normalStatePath_str, 
						objData.selectedStatePath_str, 
						objData.type, 
						objData.regPoint, 
						objData.toolTipLabel, 
						i,
						objData.markerX,
						objData.markerY,
						objData.markerWidth, 
						objData.markerHeight,
						objData.showAfterScale,
						objData.hasContent_bl);
				marker.addListener(FWDMarker.MOUSE_OVER, self.markerOnMouseOverHandler);
				marker.addListener(FWDMarker.MOUSE_OUT, self.markerOnMouseOutHandler);
				marker.addListener(FWDMarker.MOUSE_DOWN, self.markerOnStartHandler);
				
				if(objData.type == "tooltip"){
					marker.innerHTML_str = objData.innerHTML;
				}else if(objData.type == "infowindow"){
					marker.innerHTML_str = objData.innerHTML;
				}else if(objData.type == "link"){
					marker.link_str = objData.link;
					marker.target_str = objData.target;
				}
				self.markers_ar.push(marker);
				self.addChild(marker);
			}
		};
		
		self.markerOnMouseOverHandler = function(e){
			var marker = e.target;
			
			if(marker.hasToolTip_bl){
				self.showMarkerToolTip(marker, marker.toolTipLabel_str);
			};
			
			if(marker.type_str == "tooltip"){
				if(!marker.hasHTMLContent_bl) return;
				if(self.curMarker_do && self.curMarker_do != marker) self.curMarker_do.setNormalState();
				self.lastMarkerId_str = marker.markerId;
				self.curMarker_do = marker;
				clearTimeout(self.hideToolTipWindowId_to);
				self.showToolTipWindow(marker);
			}
		};
		
		self.markerOnMouseOutHandler = function(e){
			
			var marker = e.target;
			if(marker.hasToolTip_bl){
				if(self.markersToolTip_do){
					if(self.contains(self.markersToolTip_do)) self.removeChild(self.markersToolTip_do);
					self.markersToolTip_do.hide();
				}
			};
			
			if(marker.type_str == "tooltip"){
				if(!marker.hasHTMLContent_bl){
					marker.setNormalState();
					return;
				}
				self.toolTipWindowAddEventsToSetGlobalXAndGlobalY();
				clearTimeout(self.hideToolTipWindowId_to);
				self.hideToolTipWindowId_to = setTimeout(self.hideToolTipWindowWithDelay, 300);
			}
		};
		
		self.markerOnStartHandler = function(e){
			var marker = e.target;
			if(marker.type_str == "infowindow"){
				self.dispatchEvent(FWDImageManager.SHOW_INFO, {text:marker.innerHTML_str});
			}else if(marker.type_str == "tooltip" && self.isMobile_bl){	
				if(!marker.hasHTMLContent_bl) return;	
				if(self.lastMarkerId_str != marker.markerId) self.hideToolTipWindow();
				self.lastMarkerId_str = marker.markerId;
				self.curMarker_do = marker;
				self.toolTipWindowAddEventsToSetGlobalXAndGlobalY();
				self.showToolTipWindow(marker);
			}
		};
	
		//show markers firs time
		this.showMarkersFirstTime = function(){
			self.showMarkersFirstTimeId_to = setTimeout(function(){
				self.showMarkersFirstTimeDone_bl = true;
				self.positionMarkers();
			}, 2100);
		};
		
		//position markers.
		self.positionMarkers = function(animate){
			var marker;
			
			for(var i=0; i< self.totalMarkers; i++){
				marker = self.markers_ar[i];
				
				marker.finalX = self.finalX + marker.offsetX + parseInt(marker.originalX * self.currentScale);
				marker.finalY = self.finalY + marker.offsetY + parseInt(marker.originalY * self.currentScale);
				
				if(marker.showAfterScale <= self.currentScale){
					if(self.showMarkersFirstTimeDone_bl) marker.show();	
				}else{
					marker.hide();
				}
			
				if(marker.isShowed_bl){
					if(animate){
						FWDAnimation.killTweensOf(marker);
						FWDAnimation.to(marker, .3, {x:marker.finalX, y:marker.finalY});
					}else{
						FWDAnimation.killTweensOf(marker);
						marker.setX(marker.finalX);
						marker.setY(marker.finalY);
						
					}
				}
			}
		};
		
		this.hideMarkers = function(){
			var marker;
			for(var i=0; i< self.totalMarkers; i++){
				marker = self.markers_ar[i];
				marker.isHiddenFinal_bl = true;
				marker.hide();
			}
		};
		
		this.showMarkers = function(){
			var marker;
			for(var i=0; i< self.totalMarkers; i++){
				marker = self.markers_ar[i];
				marker.isHiddenFinal_bl = false;
				if(marker.showAfterScale <= self.currentScale) marker.show();	
			}
		};
		
		//###########################################//
		/* Setup markers tooltip */
		//###########################################//
		self.setupMarkersToolTip = function(){
			FWDMarkerToolTip.setPrototype();
			self.markersToolTip_do = new FWDMarkerToolTip(
					self.toolTipLeft_img,
					self.toolTipPointer_img,
					self.buttonToolTipLeft_str,
					self.buttonToolTipMiddle_str,
					self.buttonToolTipRight_str,
					self.buttonToolTipFontColor_str,
					self.buttonToolTipTopPointer_str,
					self.buttonToolTipBottomPointer_str);
		};
		
		//###########################################//
		/* Setup markers tooltip window*/
		//###########################################//
		self.setupMarkersToolTipWindows = function(){
			var toolTipWindow_do;
			for(var i =0; i < self.totalToolTipsWindows; i++){
				FWDMarkerWindowToolTip.setPrototype();
				toolTipWindow_do = new FWDMarkerWindowToolTip(
						parent.main_do,
						self.toolTipPointer_img,
						self.toolTipDataWindows_ar[i].innerHTML,
						self.buttonToolTipTopPointer_str,
						self.buttonToolTipBottomPointer_str,
						self.toolTipDataWindows_ar[i].maxWidth);
				
				self.toolTipWindows_ar.push(toolTipWindow_do);
				parent.main_do.addChild(toolTipWindow_do);
			}
		};	
		
		//######################################################//
		/* show tool tip */
		//######################################################//
		self.showMarkerToolTip = function(marker, label){
			
			var finalX;
			var finalY;
			var globalX = self.getX();
			var pointerOffsetX = 0;
			var pointerPostion;
			
			clearTimeout(self.showMarkerToolTipId_to);
			self.addChild(self.markersToolTip_do);
			self.markersToolTip_do.setLabel(label);
			self.markersToolTip_do.show();
		
			self.showMarkerToolTipId_to = setTimeout(function(){
				
				finalX = parseInt(marker.finalX + (marker.width - self.markersToolTip_do.totalWidth)/2);
				finalY = marker.finalY - self.markersToolTip_do.totalHeight - self.markerToolTipOffsetY;
				
				if(finalY < 0 ||
						(self.controllerPosition_str == FWDController.POSITION_TOP && finalY < self.controllerHeight + self.controllerOffsetY)){
					finalY = marker.finalY + marker.height + self.markersToolTip_do.pointerHeight + self.markerToolTipOffsetY;
					self.markersToolTip_do.pointerUp_sdo.setVisible(true);
					self.markersToolTip_do.pointerDown_sdo.setVisible(false);
					pointerPostion = FWDMarkerToolTip.POINTER_UP;
				}else{
					self.markersToolTip_do.pointerUp_sdo.setVisible(false);
					self.markersToolTip_do.pointerDown_sdo.setVisible(true);
					pointerPostion = FWDMarkerToolTip.POINTER_DOWN;
				}
				
				if(finalX < 0){
					pointerOffsetX = finalX;
					finalX = 0;
				}else if(self.stageWidth - finalX - self.markersToolTip_do.totalWidth < 0){
					pointerOffsetX = -(self.stageWidth - finalX - self.markersToolTip_do.totalWidth);
					finalX = finalX + self.stageWidth - finalX - self.markersToolTip_do.totalWidth;
				}
			
				self.markersToolTip_do.setX(finalX);
				self.markersToolTip_do.setY(finalY);	
				self.markersToolTip_do.positionPointer(pointerOffsetX, pointerPostion);
			}, 51);
		};
		
			
		//######################################################//
		/* show tool tip window */
		//######################################################//
		self.showToolTipWindow = function(marker){
			
			var curId = marker.id;
			var finalX;
			var finalY;
			var globalX = self.getX();
			var pointerOffsetX = 0;
			var pointerPostion;
			
			if(self.markersToolTipWindow_do != self.toolTipWindows_ar[marker.id] && self.markersToolTipWindow_do)  self.markersToolTipWindow_do.hide();
				
			for(var i=0; i<marker.id; i++){
				objData = self.markersList_ar[i];
				if(objData.type != "tooltip") curId --;
			}
		
			self.markersToolTipWindow_do = self.toolTipWindows_ar[curId];
			
			clearTimeout(self.showToolTipWindoId_to);
			self.showToolTipWindoId_to = setTimeout(function(){
				finalX = parseInt(marker.finalX + (marker.width - self.markersToolTipWindow_do.totalWidth)/2);
				finalY = marker.finalY - self.markersToolTipWindow_do.totalHeight - self.markerToolTipOffsetY;
				
				if(finalY < 0 ){
					finalY = marker.finalY + marker.height + self.markersToolTipWindow_do.pointerHeight + self.markerToolTipOffsetY;
					self.markersToolTipWindow_do.pointerUp_sdo.setVisible(true);
					self.markersToolTipWindow_do.pointerDown_sdo.setVisible(false);
					pointerPostion = FWDMarkerWindowToolTip.POINTER_UP;
				}else{
					finalY = marker.finalY - self.markersToolTipWindow_do.totalHeight - self.markerToolTipOffsetY;
					self.markersToolTipWindow_do.pointerUp_sdo.setVisible(false);
					self.markersToolTipWindow_do.pointerDown_sdo.setVisible(true);
					pointerPostion = FWDMarkerWindowToolTip.POINTER_DOWN;
				}
			
				if(finalX < 0){
					pointerOffsetX = finalX;
					finalX = 0;
				}else if(self.stageWidth - finalX - self.markersToolTipWindow_do.totalWidth < 0){
					pointerOffsetX = -(self.stageWidth - finalX - self.markersToolTipWindow_do.totalWidth);
					finalX = finalX + self.stageWidth - finalX - self.markersToolTipWindow_do.totalWidth;
				}
				
				self.markersToolTipWindow_do.setX(finalX);
				self.markersToolTipWindow_do.setY(finalY);	
				self.markersToolTipWindow_do.positionPointer(pointerOffsetX, pointerPostion);
				self.markersToolTipWindow_do.show();
				
			}, 51);
		};
		
		//######################################################//
		/* hide tool tip window */
		//######################################################//
		self.toolTipWindowAddEventsToSetGlobalXAndGlobalY = function(){
			if(self.isMobile_bl){
				self.addHideToolTipWindowTestWithDelayId_to = setTimeout(function(){
					if(self.hasPointerEvent_bl){
						window.addEventListener("MSPointerDown", self.hideToolTipWindowTest);
						window.addEventListener("MSPointerMove", self.hideToolTipWindowTest);
					}else{
						window.addEventListener("touchstart", self.hideToolTipWindowTest);
					}
				}, 50);
			}else{
				if(window.addEventListener){
					window.addEventListener("mousemove", self.hideToolTipWindowTest);
				}else if(document.attachEvent){
					document.detachEvent("onmousemove", self.hideToolTipWindowTest);
					document.attachEvent("onmousemove", self.hideToolTipWindowTest);
				}
			}
		};
		
		self.hideToolTipWindowTest = function(e){
			var viewportMouseCoordinates = FWDUtils.getViewportMouseCoordinates(e);	
			self.globalX = viewportMouseCoordinates.screenX;
			self.globalY = viewportMouseCoordinates.screenY;
			if(e.touches || e.pointerType != e.MSPOINTER_TYPE_MOUSE) self.hideToolTipWindowWithDelay();
		};
		
		self.hideToolTipWindowWithDelay = function(addDelay){
			if(!FWDUtils.hitTest(self.markersToolTipWindow_do.text_sdo.screen, self.globalX, self.globalY)
			 && !FWDUtils.hitTest(self.markersToolTipWindow_do.pointerDown_sdo.screen, self.globalX, self.globalY)
			 && !FWDUtils.hitTest(self.markersToolTipWindow_do.pointerUp_sdo.screen, self.globalX, self.globalY)
			   && !FWDUtils.hitTest(self.curMarker_do.screen, self.globalX, self.globalY)){
				self.hideToolTipWindow();
				if(self.isMobile_bl){
					clearTimeout(self.addHideToolTipWindowTestWithDelayId_to);
					if(self.hasPointerEvent_bl){
						window.removeEventListener("MSPointerDown", self.hideToolTipWindowTest);
						window.removeEventListener("MSPointerMove", self.hideToolTipWindowTest);
					}else{
						window.removeEventListener("touchstart", self.hideToolTipWindowTest);
					}
				}else{
					if(window.removeEventListener){
						window.removeEventListener("mousemove", self.hideToolTipWindowTest);
					}else if(document.detachEvent){
						document.detachEvent("onmousemove", self.hideToolTipWindowTest);
					}
				}
			}else{
				self.hideToolTipWindowId_to = setTimeout(self.hideToolTipWindowWithDelay, 300);
			}
		};
		
		self.hideToolTipWindow = function(){
			if(!self.markersToolTipWindow_do) return;
			if(self.curMarker_do && !self.isMobile_bl) self.curMarker_do.setNormalState();
			clearTimeout(self.hideToolTipWindowId_to);
			self.markersToolTipWindow_do.hide();
			self.markersToolTipWindow_do.toolTipWindowId = "none";
		};
		
		
		//####################################//
		/* markers info */
		//####################################//
		self.setupMarkersInfo = function(){
			if(window.addEventListener){
				window.addEventListener("mousemove", self.showMarkersInfoPosition);
				window.addEventListener ("mousewheel", self.showMarkersInfoPosition);
				window.addEventListener('DOMMouseScroll', self.showMarkersInfoPosition);
			}else if(document.attachEvent){
				document.attachEvent("onmousemove", self.showMarkersInfoPosition);
				document.attachEvent("onmousewheel", self.showMarkersInfoPosition);
			}
		
			self.markersPositionInfo_sdo = new FWDSimpleDisplayObject("div");
			self.markersPositionInfo_sdo.setDisplay("inline-block");
			self.markersPositionInfo_sdo.getStyle().fontSmoothing = "antialiased";
			self.markersPositionInfo_sdo.getStyle().webkitFontSmoothing = "antialiased";
			self.markersPositionInfo_sdo.getStyle().textRendering = "optimizeLegibility";
			self.markersPositionInfo_sdo.getStyle().padding = "6px";
			self.markersPositionInfo_sdo.getStyle().fontFamily = "Arial";
			self.markersPositionInfo_sdo.getStyle().fontSize= "12px";
			self.markersPositionInfo_sdo.getStyle().color = "#000000";
			self.markersPositionInfo_sdo.setBkColor("#FFFFFF");
			self.addChild(self.markersPositionInfo_sdo);
		};
		
		self.showMarkersInfoPosition = function(e){
			var viewportMouseCoordinates = FWDUtils.getViewportMouseCoordinates(e);		
			var globalX = self.getGlobalX();
			var globalY = self.getGlobalY();
			var localX = viewportMouseCoordinates.screenX - globalX;
			var localY = viewportMouseCoordinates.screenY - globalY;
			var finalX = Math.round((localX - self.finalX) * (1/self.currentScale)) + 1;
			var finalY = Math.round((localY - self.finalY) * (1/self.currentScale)) + 1;
			var infoFinalX = localX + 10;
			var infoFinalY = localY + 10;
			
			self.markersPositionInfo_sdo.setInnerHTML(
					"<font color='#FF000'>Left</font>: " + finalX + 
					"<br><font color='#FF000'>Top</font>:" + finalY + 
					"<br><font color='#FF000'>Zoom factor</font>:" + parseFloat(self.currentScale).toFixed(2));
			var infoWidth = self.markersPositionInfo_sdo.getWidth();
			var infoHeight = self.markersPositionInfo_sdo.getHeight();
			
			if(infoFinalX + infoWidth > self.stageWidth){
				infoFinalX = infoFinalX - infoWidth - 10;
			}
			
			if(infoFinalY + infoHeight > self.stageHeight){
				infoFinalY = infoFinalY - infoHeight - 10;
			}
		
			self.markersPositionInfo_sdo.setX(infoFinalX);
			self.markersPositionInfo_sdo.setY(infoFinalY);
		};
		
		
		//##################################//
		//various methods.
		//##################################//
		self.setDraggingMode = function(draggingMode){
			self.draggingMode_str = draggingMode;
		};
		
		self.disableOrEnablePanOrTouch = function(bool){
			self.isControllerActive_bl = bool;
		};
		
		self.panWithButtons = function(dir){
			if(dir == "left"){
				self.finalX -= self.panSpeed * self.panDirectionSign;
			}else if(dir == "right"){
				self.finalX += self.panSpeed * self.panDirectionSign;
			}else if(dir == "down"){
				self.finalY += self.panSpeed * self.panDirectionSign;
			}else if(dir == "up"){
				self.finalY -= self.panSpeed * self.panDirectionSign;
			}
			self.checkXAndYBouds();
			self.resizeAndPositionImage();
			self.positionMarkers(false);
			self.updateNavigator();
		};
		
		self.zoomInOrOutWithScrollBar = function(percent){	
			self.currentScale = percent * (self.zoomFactor - self.smallestPossibleScale) + self.smallestPossibleScale;
			self.mouseX = self.stageWidth/2;
			self.mouseY = self.stageHeight/2;
			self.zoomImage(true, true);
		};
		
		self.dispatchScrollBarUpdate = function(animate){
			if(self.currentScale < self.zoomFactor){
				self.dispatchEvent(FWDImageManager.SCROLL_BAR_UPDATE, {percent:(self.currentScale - self.smallestPossibleScale)/(self.zoomFactor - self.smallestPossibleScale), animate:animate});
			}else{
				self.dispatchEvent(FWDImageManager.SCROLL_BAR_UPDATE, {percent:1, animate:animate});
			}
		};
		
		self.zoomInOrOutWithButtons = function(dir, withPause){
			self.mouseX = self.stageWidth/2;
			self.mouseY = self.stageHeight/2;
			
			if(dir > 0){
				//if(self.currentScale == self.zoomFactor) return;
				if(withPause){
					self.currentScale += self.zoomSpeed;
				}else{
					self.currentScale += self.zoomSpeed/15;
				}
				if(self.currentScale > self.zoomFactor) self.currentScale = self.zoomFactor;
			}else if(dir < 0){
				//if(self.finalWidth <= self.stageWidth) return;
				if(withPause){
					self.currentScale -= self.zoomSpeed;
				}else{
					self.currentScale -= self.zoomSpeed/15;
				}
				if(parseFloat(self.currentScale.toFixed(5)) <= parseFloat(self.smallestPossibleScale.toFixed(5))) self.currentScale = self.smallestPossibleScale;
			}
			self.dispatchScrollBarUpdate(true, true);
			
			self.zoomImage(true, true);
		};
		
		self.centerImage = function(){
			self.mouseX = self.stageWidth/2;
			self.mouseY = self.stageHeight/2;
			self.finalX =  Math.round((self.stageWidth - self.finalWidth)/2);
			self.finalY =  Math.round((self.stageHeight - self.finalHeight)/2);	
		};
		
		//############################################//
		/* navigator utils */
		//############################################//
		self.updateNavigator = function(animate){
			if(!self.isNavigatorShowed_bl) return;
			
			self.dispatchEvent(FWDImageManager.UPDATE_NAVIGATOR, {
				percentX:Math.abs(self.finalX/(self.finalWidth - self.stageWidth)),
				percentY:Math.abs(self.finalY/(self.finalHeight - self.stageHeight)),
				percentWidth:self.stageWidth/self.finalWidth,
				percentHeight:self.stageHeight/self.finalHeight,
				animate:animate
			});
		};
		
		self.hideOrShowNavigator = function(){
			if(self.stageWidth < self.finalWidth || self.stageHeight < self.finalHeight){
				self.isNavigatorShowed_bl = true;
				self.dispatchEvent(FWDImageManager.SHOW_NAVIGATOR);
			}else{
				self.isNavigatorShowed_bl = false;
				self.dispatchEvent(FWDImageManager.HIDE_NAVIGATOR);
			}
		};
		
		self.updateOnNavigatorPan = function(percentX, percentY){
			
			self.finalX = parseInt(percentX * (self.stageWidth - self.finalWidth));
			self.finalY = parseInt(percentY * (self.stageHeight - self.finalHeight));
			
			self.positionMarkers(true);
			self.resizeAndPositionImage(true);
		};
		
		self.disableOrEnableMoveButtons = function(){
			if(self.stageHeight < self.finalHeight){
				if(!self.areUpAndDownButtonsDisabled_bl ){
					self.dispatchEvent(FWDImageManager.ENABLE_UP_AND_DOWN_BUTTONS);
					self.areUpAndDownButtonsDisabled_bl = true;
				}
			}else{
				if(self.areUpAndDownButtonsDisabled_bl){
					self.dispatchEvent(FWDImageManager.DISABLE_UP_AND_DOWN_BUTTONS);
					self.areUpAndDownButtonsDisabled_bl = false;
				}
			}
		
			if(self.stageWidth < self.finalWidth){
				if(!self.areLeftAndRightButtonsDisabled_bl){
					self.dispatchEvent(FWDImageManager.ENABLE_LEFT_AND_RIGHT_BUTTONS);
					self.areLeftAndRightButtonsDisabled_bl = true;
				}
			}else{
				if(self.areLeftAndRightButtonsDisabled_bl){
					self.dispatchEvent(FWDImageManager.DISABLE_LEFT_AND_RIGHT_BUTTONS);
					self.areLeftAndRightButtonsDisabled_bl = false;
				}
			}	
		};
		
	
		//#################################//
		//Clean main events.
		//#################################//
		self.cleanMainEvents = function(){
			
			if(self.isMobile_bl){
				self.dumy_sdo.screen.removeEventListener("touchstart", self.panStartHandler);
				self.dumy_sdo.screen.removeEventListener("MSPointerDown", self.panStartHandler);
				window.removeEventListener("touchmove", self.panMoveHandler);
				window.removeEventListener("touchend", self.panEndHandler);
				window.removeEventListener("MSPointerMove", self.panMoveHandler);
				window.removeEventListener("MSPointerUp", self.panEndHandler);
				
				window.removeEventListener("touchstart", self.hideToolTipWindowTest);
				window.removeEventListener("MSPointerDown", self.hideToolTipWindowTest);
				window.removeEventListener("MSPointerMove", self.hideToolTipWindowTest);
				
				self.dumy_sdo.screen.removeEventListener('gesturestart', self.gestureStartHandler);
				self.dumy_sdo.screen.removeEventListener('gesturechange', self.gestureChangeHandler);
				
				self.dumy_sdo.screen.removeEventListener("touchstart", self.onSecondDown);
				self.dumy_sdo.screen.removeEventListener("touchstart", self.onFirstDown);
			}else{
				if(window.removeEventListener){
					self.dumy_sdo.screen.removeEventListener("mousedown", self.panStartHandler);
					window.removeEventListener("mousemove", self.panMoveHandler);
					window.removeEventListener("mouseup", self.panEndHandler);	
					
					self.dumy_sdo.screen.removeEventListener ("mousewheel", self.mouseWheelHandler);
					self.dumy_sdo.screen.removeEventListener('DOMMouseScroll', self.mouseWheelHandler);
					
					window.removeEventListener("mousemove", self.hideToolTipWindowTest);
					
					window.removeEventListener("mousemove", self.showMarkersInfoPosition);
					window.removeEventListener ("mousewheel", self.showMarkersInfoPosition);
					window.removeEventListener('DOMMouseScroll', self.showMarkersInfoPosition);
				
					self.dumy_sdo.screen.removeEventListener("mousedown", self.onSecondDown);
					self.dumy_sdo.screen.removeEventListener("mousedown", self.onFirstDown);
				}else if(document.detachEvent){
					document.detachEvent("onmousemove", self.panMoveHandler);
					document.detachEvent("onmouseup", self.panEndHandler);
					self.dumy_sdo.screen.detachEvent("onmousedown", self.panStartHandler);
					
					self.dumy_sdo.screen.detachEvent("onmousewheel", self.mouseWheelHandler);
					
					document.detachEvent("onmousemove", self.hideToolTipWindowTest);
					
					document.detachEvent("onmousemove", self.showMarkersInfoPosition);
					document.detachEvent("onmousewheel", self.showMarkersInfoPosition);
				}
			}
			
			clearTimeout(self.tweenDone_to);
			clearTimeout(self.removeSmallSDOId_to);
			clearTimeout(self.setAlphaWithDelayId_to);
			clearTimeout(self.hideToolTipWindowId_to);
			clearTimeout(self.addHideToolTipWindowTestWithDelayId_to);
			clearTimeout(self.showToolTipWindoId_to);
			clearTimeout(self.showMarkerToolTipId_to);
			clearTimeout(self.setupMarkersAndToolTipWindowsId_to);
			clearTimeout(self.secondTapId_to);
			clearTimeout(self.enableMarkersId_to);
			clearTimeout(self.showMarkersFirstTimeId_to);
		};
		
		//#################################//
		/* destroy */
		//################################//
		self.destroy = function(){
			self.cleanMainEvents();
		
			if(self.smallImage_sdo){
				FWDAnimation.killTweensOf(self.smallImage_sdo);
				self.smallImage_sdo.destroy();
			}
			
			self.removeZoomDragAndSwipeForMobile();
			
			if(self.showMarkers_bl){
				var marker;
				var toolTipWindow;
				for(var i=0; i<self.totalMarkers; i++){
					marker = self.markers_ar[i];
					FWDAnimation.killTweensOf(marker);
					marker.destroy();
				}
				if(self.markersToolTip_do) self.markersToolTip_do.destroy();
				
				for(var i =0; i < self.totalToolTipsWindows; i++){
					toolTipWindow = self.toolTipWindows_ar[i];
					if(toolTipWindow) toolTipWindow.destroy();
				}
			}
			
			self.dumy_sdo.screen.style.cursor = "default";
			self.dumy_sdo.destroy();
			
			if(self.markersPositionInfo_sdo){
				self.markersPositionInfo_sdo.setInnerHTML("");
				self.markersPositionInfo_sdo.destroy();
			}
			
			data = null;
			parent = null;
			
			self.toolTipDataWindows_ar = null;
			self.markersList_ar = null;
			self.markersPosition_ar = null;
			self.largeImagesPaths_ar = null;
			
			self.hider = null;
			self.curMarker_do = null;
			self.dumy_sdo = null;
			self.smallImage_sdo = null;
			self.markersPositionInfo_sdo = null;
			
			self.handMovePath_str = null;
			self.handGrabPath_str = null;
			self.backgroundColor_str = null;
			self.draggingMode_str = null;
			
			self.setInnerHTML("");
			prototype.destroy();
			self = null;
			prototype = null;
			FWDImageManager.prototype = null;
		};
		
		self.init();
	};
	
	/* set prototype */
	FWDImageManager.setPrototype =  function(){
		FWDImageManager.prototype = new FWDDisplayObject("div");
	};
	
	FWDImageManager.LARGE_IMAGE_LOAD_ERROR = "largeImageLoadError";
	FWDImageManager.IMAGE_ZOOM_COMPLETE = "zoomComplete";
	FWDImageManager.SCROLL_BAR_UPDATE = "scrollBarUpdate";
	FWDImageManager.PAN_START = "panStart";
	FWDImageManager.PAN = "pan";
	FWDImageManager.UPDATE_NAVIGATOR = "updateNavigator";
	FWDImageManager.SHOW_NAVIGATOR = "showNavigator";
	FWDImageManager.HIDE_NAVIGATOR = "hideNavigator";
	FWDImageManager.SHOW_INFO = "showInfo";
	FWDImageManager.DISABLE_LEFT_AND_RIGHT_BUTTONS = "disableLeftAndRightButtons";
	FWDImageManager.ENABLE_LEFT_AND_RIGHT_BUTTONS = "enableLeftAndRightButtons";
	FWDImageManager.DISABLE_UP_AND_DOWN_BUTTONS = "disableUpAndDownButtons";
	FWDImageManager.ENABLE_UP_AND_DOWN_BUTTONS = "enableUpAndDownButtons";
	

	FWDImageManager.prototype = null;
	window.FWDImageManager = FWDImageManager;
	
}(window));