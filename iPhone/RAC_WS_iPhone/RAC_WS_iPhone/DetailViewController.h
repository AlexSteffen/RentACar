//
//  DetailViewController.h
//  RAC_WS_iPhone
//
//  Created by Alexander Steffen on 03.09.12.
//  Copyright (c) 2012 Alexander Steffen. All rights reserved.
//

#import <UIKit/UIKit.h>

@interface DetailViewController : UIViewController

@property (weak, nonatomic) IBOutlet UIImageView *myPicture;
@property (weak, nonatomic) IBOutlet UILabel *myManufacturer;
@property (weak, nonatomic) IBOutlet UILabel *myModell;
@property (weak, nonatomic) IBOutlet UILabel *myType;
@property (weak, nonatomic) IBOutlet UILabel *myColor;


@end
