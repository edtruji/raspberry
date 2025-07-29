from escpos.printer import Usb

# VID and PID from your lsusb output
vid = 0x0483
pid = 0x5743

# Initialize the USB printer
p = Usb(vid, pid)

# Print a QR code
p.text("QR Code Example:\n")
p.qr("https://cnn.com", size=8)  # URL for the QR code; adjust size (1-10) as needed

# Add some spacing
p.text("\n\n")

# Print a barcode
p.text("Barcode Example (Code 128):\n")
p.barcode("1234567890", "CODE128", height=80, width=3, pos="BELOW", align_ct=True)

# Cut the paper
p.cut()

# Close the printer connection
p.close()