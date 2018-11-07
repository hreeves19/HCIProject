import numpy as np
import cv2
import sys
import os

def main():
    filename_ext = str(sys.argv[1])
    filename = str(sys.argv[1])
    filename = filename[:-4]

    # Load an color image in grayscale
    src = cv2.imread(filename_ext)
    img = cv2.resize(src, (1000, 1000)) 
    vis = src.copy()
    new = ""

    # define the name of the directory to be created
    path = "C:/xampp/htdocs/Hci_Project/Scripts/Images/" + str(filename)

    try:  
        os.mkdir(path)
    except OSError:  
        print ("Creation of the directory %s failed" % path)
    else:  
        print ("Successfully created the directory %s " % path)

    channels = cv2.text.computeNMChannels(src)

    # Looping through the channels
    for channel in channels:
        # Loading classifier
        erc1 = cv2.text.loadClassifierNM1("trained_classifierNM1.xml")
        erc2 = cv2.text.loadClassifierNM2("trained_classifierNM2.xml")

        # Creating ER Filters
        er_filter1 = cv2.text.createERFilterNM1(erc1, 16, 0.00015, 0.13, 
        0.2, True, 0.1)

        er_filter2 = cv2.text.createERFilterNM2(erc2, 0.5)

        # Detecting regions
        regions = cv2.text.detectRegions(channel, er_filter1, er_filter2)

        # Find groups of Extremal Regions that are organized as text blocks
        rects = cv2.text.erGrouping(src,channel,[r.tolist() for r in regions])

        #Visualization
        for r in range(0,np.shape(rects)[0]):
            rect = rects[r]

            # Drawing rectangles on vis
            cv2.rectangle(vis, (rect[0],rect[1]), (rect[0]+rect[2],rect[1]+rect[3]), (0, 0, 0), 2)
            cv2.rectangle(vis, (rect[0],rect[1]), (rect[0]+rect[2],rect[1]+rect[3]), (255, 255, 255), 1)
            
            # Cropping the image so it is just text
            roi = vis[rect[1]:rect[1]+rect[3], rect[0]:rect[0]+rect[2]]

            # Writing cropped image
            cv2.imwrite(str(path) + "/" + str(filename) + "_Cropped_" + str(r) + ".jpg", roi)


    # Writting result to image
    cv2.imwrite(str(path) + "/" + str(filename) + "_Extracted_Text.jpg", vis)



if __name__ == "__main__":
    main()


