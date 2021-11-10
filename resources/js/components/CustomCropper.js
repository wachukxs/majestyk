import Cropper from "react-cropper";
import "cropperjs/dist/cropper.css";
import React, { useRef, useState, useEffect } from "react";

function CustomCropper(props) {

    const defaultSrc = "https://raw.githubusercontent.com/roadmanfong/react-cropper/master/example/img/child.jpg";
    const cropperRef = useRef(null);
    const [image, setImage] = useState(defaultSrc);
    const [cropData, setCropData] = useState(null);
    const [cropper, setCropper] = useState();

    useEffect(()=>{
        console.log('it changed');
        getCropData()
    }, [props.imageSize])
    useEffect(()=>{
        console.log('it doing');
        setImage(props.imgIn)
    }, [props.imgIn])
    

    const onCrop = () => {
        if (cropperRef) {
            const imageElement = cropperRef.current;
            const cropper = imageElement.cropper;
            // console.log('onCrop: ', cropper.getCroppedCanvas().toDataURL());
        }
    };

    const getCropData = () => {
        console.log('cropping for', props.imageSize);
        
        if (typeof cropper !== "undefined") {
            console.log('cropper', cropper);
            console.log('date', cropper.getImageData());

            if (props.imageSize == "square") {
                console.log('cropped for square');
                setImageSize(cropper.getImageData().height > cropper.getImageData().width ? cropper.getImageData().width : cropper.getImageData().height ) // use the least width or height of the image
                setCropData(cropper.getCroppedCanvas().toDataURL());
                setImage(cropData)
            } else if (props.imageSize == "small") {
                setImageSize(256)
                setCropData(cropper.getCroppedCanvas().toDataURL());
                setImage(cropData)
                console.log('cropped for small');
            } else if (props.imageSize == "all") {
                setCropData(cropper.getCroppedCanvas().toDataURL());
                setImage(cropData)
                console.log('cropped for all');
            } else { // original
                cropper.reset()
                setImage(cropData)
                console.log('cropped for original'); // so won't do anything
                // setCropData(cropper.getCroppedCanvas().toDataURL());
            }
        }
    };

    const setImageSize = (size) => {
        cropper.setCropBoxData({
            left: cropper.getCanvasData().left,
            top: cropper.getCanvasData().top,
            width: size,
            height: size
        })
    }

    return (
        <>
        <Cropper
            src={image}
            style={{ height: 400, width: "100%" }}
            // Cropper.js options
            initialAspectRatio={16 / 9}
            guides={false}
            crop={onCrop}
            ref={cropperRef}
            onInitialized={(instance) => {
                setCropper(instance);
            }}
            guides={true}
        />

        <button onClick={() => {
            getCropData()
            console.log('updating ...', cropData);
            props.updateImg(cropData)
        }}>
            Crop Image
        </button>
        </>
    )
}
export default CustomCropper

// if (document.getElementById('the-cropper')) {
//     ReactDOM.render(<CustomCropper />, document.getElementById('the-cropper'));
// }