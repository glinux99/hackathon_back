from ultralytics import YOLO
import easyocr
import tensorflow as tf
import torchvision.transforms as transforms
from PIL import Image
import pandas as pd
import torch
import matplotlib.pyplot as plt
import numpy as np

yolo_model = YOLO('yolov8n.pt')  
ocr_reader = easyocr.Reader(['en'])
efficientnet_model = tf.keras.applications.EfficientNetB0(weights='imagenet')

transform = transforms.Compose([
    transforms.Resize((224, 224)),      transforms.ToTensor(),
    transforms.Normalize(mean=[0.485, 0.456, 0.406], std=[0.229, 0.224, 0.225]),
])


def display_image(image, title=None):
    plt.figure(figsize=(6, 6))
    plt.imshow(image)
    plt.axis("off")
    if title:
        plt.title(title)
    plt.show()
while True:
  
  from google.colab import files
  uploaded = files.upload()

  if uploaded:
      file_name = next(iter(uploaded))  
      image = Image.open(file_name)

      
      display_image(image, "Image Originale")

      print("\n=== Détection d'Objets avec YOLO ===")
      yolo_results = yolo_model(image)  
      annotated_image = yolo_results[0].plot()  
      display_image(annotated_image, "Résultats YOLO")  

      print("Structure de yolo_results[0]:")
      print(yolo_results[0])

      detections = []
      for result in yolo_results[0].boxes:
          detection = {
              "Classe": result.cls, 
              "Confiance": result.conf, 
          }
          detections.append(detection)

      print("\n=== Reconnaissance des Plaques d'Immatriculation ===")
      ocr_results = ocr_reader.readtext(file_name)
      for bbox, text, prob in ocr_results:
          print(f"Texte détecté : {text} (Confiance : {prob:.2f})")

      print("\n=== Classification d'Images avec EfficientNet ===")
      img_tensor = transform(image).unsqueeze(0)
      img_tensor = img_tensor.permute(0, 2, 3, 1).numpy()

      output = efficientnet_model.predict(img_tensor)
      predicted_class = tf.keras.applications.efficientnet.decode_predictions(output, top=1)
      print(f"Classe prédite : {predicted_class[0][0][1]} (Confiance : {predicted_class[0][0][2]:.2f})")

      results = {
          "Détection d'objets": [d['Classe'] for d in detections],
          "Plaque détectée": [text for _, text, _ in ocr_results],
          "Classe d'image": predicted_class[0][0][1],
      }
      df = pd.DataFrame([results])
      print("\n=== Résumé des Résultats ===")
      print(df)

      csv_file = "results_goma.csv"
      try:
        if not pd.io.common.file_exists(csv_file):
            df.to_csv(csv_file, index=False)
        else:
            df.to_csv(csv_file, mode='a', header=False, index=False)
        print(f"Les résultats ont été ajoutés à '{csv_file}'.")
      except Exception as e:
          print(f"Erreur lors de la sauvegarde des résultats : {e}")
          print("\nLes résultats ont été exportés dans 'results_goma.csv'.")
  choix = input("\nVoulez-vous traiter une autre image ? (oui/non) : ").strip().lower()
  if choix != "oui":
    print("Fin du traitement. Merci d'avoir utilisé le programme !")
    break