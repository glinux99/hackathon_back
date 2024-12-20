from ultralytics import YOLO

model = YOLO('yolov8n.pt')  

model.train(
    data="/content/dossier_extrait/data.yaml",  l
    epochs=50,                
    imgsz=640,                
    batch=16,                 
    workers=2                 
)


metrics = model.val()


model.export(format="onnx")  
