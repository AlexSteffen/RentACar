//
//  DetailViewController.m
//  RAC_WS_iPhone
//
//  Created by Alexander Steffen on 03.09.12.
//  Copyright (c) 2012 Alexander Steffen. All rights reserved.
//

#import "DetailViewController.h"
#import "RentACarRentACar.h"

@interface DetailViewController ()

@end

@implementation DetailViewController


@synthesize myPicture;
@synthesize myManufacturer;
@synthesize myModell;
@synthesize myType;
@synthesize myColor;

- (id)initWithNibName:(NSString *)nibNameOrNil bundle:(NSBundle *)nibBundleOrNil
{
    self = [super initWithNibName:nibNameOrNil bundle:nibBundleOrNil];
    if (self) {
        // Custom initialization
    }
    return self;
}

- (void)viewDidLoad
{
    [super viewDidLoad];
    
    
    RentACarRentACar *service = [[RentACarRentACar alloc]init];
    
    [service getVehicleById:self action:@selector(handleGetVehicleById:) id:1];
    
    
    
	// Do any additional setup after loading the view.
}

- (void)viewDidUnload
{
    [self setMyPicture:nil];
    [self setMyManufacturer:nil];
    [self setMyModell:nil];
    [self setMyType:nil];
    [self setMyColor:nil];
    [super viewDidUnload];
    // Release any retained subviews of the main view.
}

- (BOOL)shouldAutorotateToInterfaceOrientation:(UIInterfaceOrientation)interfaceOrientation
{
    return (interfaceOrientation == UIInterfaceOrientationPortrait);
}


- (void)handleGetVehicleById:(id)value {
    
    
    if ([value isKindOfClass:[RentACarVehicle class]]) {
        
        RentACarVehicle *car = value;
     
    
        myPicture.image = [UIImage imageWithData:car.binaryImage];
        myManufacturer.text = car.manufacturer;
        myColor.text = car.color;
        myModell.text = car.model;
        myType.text = car.type;
    }
    
}

@end
