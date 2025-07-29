from escpos.printer import Usb

# VID and PID from your lsusb output for the Xprinter XP-A160M
vid = 0x0483  # Vendor ID
pid = 0x5743  # Product ID

p = Usb(vid, pid)
p.text("Hello World!\n")
p.text("Hello From USA!\n")
p.text("Hello From CHINA!\n")
p.cut()