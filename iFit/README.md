## iFIT

[Icon Health & Fitness](https://www.iconfitness.com/#/our-brands) manufactures exercise equipment under the names iFit, Proform, NordicTrack, FreeMotion, and Altra.

Originally, most treadmills would connect to a computer via a 3.5mm stereo cable to be able to stream an online workout.
The computer would stream a serene video and a personal trainer's voice would intermittently come through with encouragement.  During the workout, audible
tones could be heard which instructed the equipment to adjust speed and incline.

To create a workout, the audio stream had to be injected with individual mp3 files for every combination of speed and incline.

## Audio Workout Beta 1

While working here, I developed a workout builder using Visual Basic.  It allowed a user to create their own workout by
dragging colored vertical columns that represented the incline and speed.

### Audio Innovation

In order to avoid having an ugly "beep" or "tone" during the workout, my software would temporarily switch to mono audio
and would output the "beep" only through the left channel.  The participant's music would remain uninterrupted and we could
easily control the treadmill settings.

### Reception

Unfortunately, the powers that be decided that it was unsafe to allow home users to create their own workouts.  The project
was scrapped, and we began work on the iFit version 2.

## iFit Version 2

iFit Version 2 was a small, rectangular box that used a network cable to communicate with the exercise equipment.  Instead of
using audio tones, it uses digital signals to communicate with the equipment.  The engineer that designed it based the signals
on the MIDI standard.

Unfortunately, the MIDI standard does not have any confirmation packets, so several times a command would be sent to the equipment
and the change would not be made.  This led to very erratic workouts (for instance, the speed may be set to 5 mph and the speed
change signal would be sent to lower the speed to 2 mph for the cooldown.  When this change signal was not received correctly, the
end user would keep on running past the end of the workout).

### Driver Innovation

I was tasked to build a device driver for the box and create redundancy into the code to overcome these limitations.  I designed a
Windows Device Driver that could be installed using InstallShield.  Once installed it could communicate with the box and perform a
series of diagnostics.

The code implemented a FIFO stack and only removed an item off the stack if it was successfully confirmed by the equipment using a
series of requests and queries.  For this to work, it would send a signal to adjust the speed to 2mph (as an example).  It would then
request the current speed of the equipment.  It would average the responses over time until they reached 2mph.  This was essential
because as a person was running, the actual belt speed could fluctuate +/-0.2mph.  Once the measurement was within an approved range,
the command was removed from the stack and the next command could be sent.

This code was originally written in Visual Basic due to the constraints of using Windows.  It was later ported to an ActiveX control
so it could be run from a web page using Internet Explorer.

### Java Port

About 3 months later, I was tasked with converting the code to Java.  I had to write the code as a JavaBean to be used within
other Swing projects.  It also had to run from a Linux server (and an IBM server running Linux).  This was all completed ahead
of time.

## Competition and Video Conferencing

### Video Conferencing with Personal Trainers
Other projects that I worked on was an online video conferencing system for personal trainers and their clients.  Reservations
could be made online and a personal trainer would be able to conduct the video conferencing with a web page.

This was done before Skype was invented, so we had to use ActiveX controls on the web page and older web cams.  Without newer
technology like AngularJS or even jQuery, all the javascript to interface with the ActiveX control was pure javascript.

The backend database was a IBM:DB2 on an IBM iSeries server.

### Competition Software

Icon contracted with a local developer to create an online racing program.  Users could network their treadmills together and
run against each other.  The software displayed a 2-dimensional map and every 10 seconds would switch to an Isometric 3d view.
The isometric view was basically a 3d line and a sphere indicating the runners.

As a side project I decided I could do better and set out to learn DirectX, 3d modeling, and Level of Detail mapping.  After about
6 months, I designed an actual 3d running game with runner models and custom scenery.  The landscape used Level Of Detail to
dynamically show more detail closer to the camera and less detail farther away.  I designed 3d trees, rock spires, and buildings to
place in the world.

The entire simulation interfaced with the exercise equipment and we tested it with up to 8 treadmills running simultaneously as
we manually adjusted the speeds.

The simulation utilized:
- DirectX
-- [DirectDraw](https://en.wikipedia.org/wiki/DirectDraw)
-- [Direct3d](https://en.wikipedia.org/wiki/Direct3D)
-- [DirectPlay](https://en.wikipedia.org/wiki/DirectPlay)
-- [DirectSound](https://en.wikipedia.org/wiki/DirectSound)
- TCP Sockets
- Sprites
- [LOD Landscapes](https://en.wikipedia.org/wiki/Level_of_detail)

Ultimately, the local developer's contract was ended and I moved onto other projects.